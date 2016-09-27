<?PHP

//数据库操作类

include_once(dirname(__FILE__) . '/DbMysql.class.php');

class Db
{

    //数据表名
    protected $ext     = '';
    protected $table   = '';
    
    protected $past    = array();
    protected $param   = array();

    //本次操作受影响的数据总条数
    public $num     = 0;

    //表信息
    private $info    = array();
    
    private $block_t = '';
    private $block_k = '';
    private $block_v = array();
    
    //MYSQL对象
    public $db      = null;

    //MYSQL 语句
    protected $sql     = '';

    //错误信息
    protected $error   = '';

    //构造函数
    public function __construct() {
        $db= DbMysql::this();
        if(isset($db->dsn['exte']))$this->ext = $db->dsn['exte'];
        $this->db = $db;
        $this->init();
    }

    //代替构造
    public function init() { }

    //更换操作的数据表
    public function table($table, $as='') {
        if(is_array($table)) {
            $tabs = array();
            foreach($table as $k=>$v) {
                $tab = '';
                if($v{0} != '#') {
                    if($v{0} != '-') $tab = "`{$this->ext}{$v}`";
                    else $tab = "`" . substr($v, 1) . "`";
                } else {
                    $tab = $v;
                }
                if(is_string($k)) $tab .= " AS `$k`";
                $tabs[] = $tab;
            }
            $this->table = implode(',', $tabs);
        } else {
            if(!empty($table)) {
                if($table{0} != '#') {
                    if($table{0} != '-') $table = "`{$this->ext}{$table}`";
                    else $table = "`" . substr($table, 1) . "`";
                }
                $this->table = $table;
                if($as != '' ) $this->table .= " AS `$as`";
            }
        }
        return $this;
    }
    
    //子查询定义
    public function block($name) {
        $this->block_t = $this->table;
        $this->block_k = $name;
    }

    //limit
    public function limit($per, $page=0) {
        if(is_string($per)) {
            $this->param['limit'] = "$per";
            return $this;
        }

        $num = (int)$per;
        if($num > 0) {
            if($page < 1) $page=1;
            $start = $num * ($page-1);
            $this->param['limit'] = "$start, $num";
        }
        return $this;
    }
    
    
    //join
    public function join($table, $as, $on, $lr = 'left') {
        if($table{0} != '#') {
            if($table{0} != '-') $table = "`{$this->ext}{$table}`";
            else $table = "`" . substr($table, 1) . "`";
        }
        $lr = strtoupper($lr);
        $this->param['join'] = " $lr JOIN $table AS `$as` ON $on ";
        return $this;
    }

    //field where order
    public function __call($name, $param) {
        if(empty($param[0])) return $this;
        $fun = strtolower($name);
        if(($fun == 'field' or $fun == 'where' or $fun == 'order' or $fun == 'group' or $fun=='having') and $param)
        $this->param[$fun] = $param[0];
        
        if(substr($fun, -4,4) == 'join') {
            $this->join($param[0], $param[1], $param[2], substr($fun,0, -4));
        }
        return $this;
    }
    
    public function __set($name, $value) {
        if(!empty($value))$this->param[$name] = $value;
    }

    public function __get($name) {
        if(isset($this->param[$name])) {
            return $this->param[$name];
        } else {
            return null;
        }
    }
    
    //自定义一条 SQL 语句
    public function query($sql) {
        
        if($this->block_k != '') {
            $this->block_v[$this->block_k] = $sql;
            $this->block_k = '';
            $this->table = $this->block_t;
            return true;
        }
        
        foreach($this->block_v as $k=>$v) {
            $sql = str_replace("#$k#", " ( $v ) ", $sql);
        }

        $sql = str_replace('#@', $this->ext, $sql);
        $rs = $this->db->query($sql);
        $this->num = $this->db->num;
        return $rs;
    }

    //取回表结构信息
    private function table_info() {
        if(empty($this->info[$this->table])) {
            $sql="show full fields from " . $this->table;
            $rs=$this->db->query($sql);
            if(is_object($rs)) {
                $info=array();
                while($line=$rs->rows()) {
                    $info[]=$line;
                }
                $this->info[$this->table]=$info;
            }
        }
        return $this->info[$this->table];
    }

    //检查数据
    private function checkarray($array, $insert=true) {
        $info   =$this->table_info();
        $count  =count($info);
        $newarr =array();
        for( $i=0;$i < $count; ++$i) {
            if(isset($array[$info[$i]['Field']])) {
                $newarr[$info[$i]['Field']]=$array[$info[$i]['Field']];
            } else if($insert and $info[$i]['Null']=='NO' and $info[$i]['Default']=='' and $info[$i]['Extra']==''){
                $this->error = "<b>Class Error:</b> Table {$this->table} Field `{$info[$i]['Field']}` is NOT NULL !";
                return false;
            }
        }
        return $newarr;
    }

    //取回表数据
    public function select($field = '*') {
        if(!$this->table) {
            $this->error = '<b>Class Error:</b>function <i>select</i> Table name not set !';
            return false;
        }
        
        $sql="SELECT ";
        if(empty($this->param['field'])) $sql .= '*'; else $sql .= $this->param['field']; 
        $sql .=" FROM " . $this->table;
        if(!empty($this->param['join']))  $sql .= $this->param['join'];
        if(!empty($this->param['where'])) $sql .= " WHERE " . $this->param['where'];
        if(!empty($this->param['group'])) $sql .= " GROUP BY " . $this->param['group'];
        if(!empty($this->param['having'])) $sql .= " HAVING " . $this->param['having'];
        if(!empty($this->param['order'])) $sql .= " ORDER BY " . $this->param['order'];
        if(!empty($this->param['limit'])) $sql .= " LIMIT " . $this->param['limit'];
        $this->past[]= $this->param;
        $this->param = array();

        $this->sql = $sql;

        $rs=$this->query($sql);
        return $rs;
    }

    //向当前表插入数据
    public function insert($data) {
        if(!$this->table) {
            $this->error = '<b>Class Error:</b>function <i>insert</i> Table name not set !';
            return false;
        }
        if(!is_array($data))return false;
        $data=$this->checkarray($data);
        if(!$data) return false;
        
        $field=array();
        $value=array();
        foreach($data as $k => $v) {
            $field[]="`{$k}`";
            $value[]="'{$v}'";
        }
        $sql="INSERT INTO ".$this->table." (".implode(",",$field).") VALUES (".implode(",",$value).")";
        $this->sql = $sql;
        if($this->query($sql)) return true;
        else return false;
    }

    //取回上次插入结果的ID
    public function get_id() {
        $data=mysql_insert_id();
        return $data;
    }

    //编辑
    public function update($data) {
        if(!$this->table) {
             $this->error = '<b>Class Error:</b>function <i>update</i> Table name not set !';
             return false;
        }
        if(!is_array($data)) {
            $set = (string)$data;
        } else {
            $data=$this->checkarray($data, false);
            if(!$data) {
                $this->error = '<b>Class Error:</b>function <i>update</i> DATA not set !';
                return false;
            }
            $field=array();
            foreach($data as $k=>$v) {
                $field[] = "`$k`='{$v}'";
            }
            $set = implode(",", $field);
        }
        
        $sql="UPDATE " . $this->table . " SET $set";

        if(isset($this->param['where'])) $sql .= " WHERE " . $this->param['where'];
        if(isset($this->param['order'])) $sql .= " ORDER BY " . $this->param['order'];
        if(isset($this->param['limit'])) $sql .= " LIMIT " . $this->param['limit'];
        $this->param = array();
        $this->sql = $sql;

        if($this->query($sql)) return true;
        else return false;
    }

    //删除表数据
    public function delete() {
        if(!$this->table) {
            $this->error = '<b>Class Error:</b>function <i>delete</i> Table name not set !';
            return false;
        }
        $sql="DELETE FROM " .$this->table;
        if(isset($this->param['where'])) $sql .= " WHERE " . $this->param['where'];
        if(isset($this->param['order'])) $sql .= " ORDER BY " . $this->param['order'];
        if(isset($this->param['limit'])) $sql .= " LIMIT " . $this->param['limit'];
        $this->param = array();
        
        $this->sql = $sql;

        if($this->query($sql)) return true;
        else return false;
    }

    //检查语句运行情况
    public function debug($num=1, $out = true) {
        $debug = "";
        if($this->error) {
            $debug .= '<hr />';
            $debug .= "<p>{$this->error}</p>";
        }

        $data = $this->db->state;
        $state = array();
        
        if($num) {
            $state[] = end($data);
        } else {
            $state = &$data;
        }

        foreach($state as $v) {
            $debug .= '<hr />';
            if(!$v['state']) {
                $debug .= '<p>SQL 语句执行错误！</p>'; 
                $debug .= '<p>MYSQL 错误信息：'.$v['error'].'</p>';
            } else {
                 $debug .= '<p>SQL 语句执行正常！</p>';
            }
            $debug .= '<p>语句：' . $v['sql'] . '</p>';
            if($v['state']) $debug .= '<p>受影响行数：' . $v['num'] . '</p>';
            $debug .= '<hr />';
        }
        
        if($out) echo $debug;
        else return $debug;
    }
}
