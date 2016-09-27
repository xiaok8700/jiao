<?PHP
/**
 * 数据库操作类  
 *
 * mysql 基本操作类，如果配置文件 config.inc.php 和类文件存在同一目录下则尝试调用该配置文件。
 * 主要功能有连接 MYSQL、发送语句、取得受影响行数 
 *
 * @name      db_mysql
 * @author    冷夜飞雨 <nj_del@163.com>
 * @version   版本号：4.2  最后修改时间：2013年06月28日
*/

class DbMysql {
    
    public $dsn = Array(
        'host' => 'localhost',  //主机名
        'user' => 'root',       //用户名
        'pass' => '123456',     //密码
        'base' => 'test',       //数据库
        'lang' => 'utf8',       //编码
        'exte' => '',           //数据表前缀
    );
    
    protected static $mysql = null;

    /**
     * SQL 语句运行状态
     * 
     * @var bool
     */
    public  $state  = Array(); 
    public  $num    = 0;

    private $link   = null;
    private $result = null;


    /**
     * 构造函数
     * 
     * @param  Array  MYSQL配置信息
     */
    private function __construct() {
        $file=dirname(__FILE__).'/mysql.cfg.php';
        if(file_exists($file)) {
            $dsn = include_once($file);
            foreach($this->dsn as $k=>$v) if(isset($dsn[$k]))$this->dsn[$k] = $dsn[$k];
        }
        self::$mysql = $this;
    }

    //静态方法
    public static function this() {
        if(!self::$mysql) self::$mysql = new self();
        return self::$mysql;
    }

    /**
    * connect 连接数据库
    * 说明：类内部方法，不能直接使用
    *
    */
    private function connect() {
        $dsn = $this->dsn;
        
        $this->link = @mysql_pconnect($dsn['host'], $dsn['user'], $dsn['pass']);
        @mysql_select_db($dsn['base'], $this->link);
        @mysql_query("SET NAMES '{$dsn['lang']}'");
        //@mysql_query("SET CHARACTER SET '{$dsn['lang']}'");
        $this->error=mysql_error();
    }

    /**
     * query 发送SQL语句
     * 
     * 返回 db_mysql_result 对象，执行错误返回 false
     * 
     * @param   string  SQL语句
     * @return  Object 
     */
    public function query($sql) {

        if(!$this->link)$this->connect();
        $state = array();
        $state['sql'] = $sql;

        $result = @mysql_query($sql);
        if($result) {
            $state['state'] = true;
            $state['error'] = '';
            $num=@mysql_num_rows($result);
            if(is_null($num))$num=@mysql_affected_rows();
            $state['num'] = $num;
        } else {
            $state['state']= false;
            $state['error']= mysql_error();
            $state['num']  = 0;
        }
        
        $this->num     = $state['num'];
        $this->state[] = $state;
        
        return new db_mysql_result($result);
    }

    /**
    * closesql 关闭 mysql 连接
    */
    public function closesql() {
        @mysql_close($this->link);
        $this->link = null;
    }
}

//资源结果处理类
class db_mysql_result {

    private $result = false;

    public function __construct(&$result) {
        if(gettype($result)=='resource') $this->result=&$result;
    }

    /**
     * get_rows
     * 
     * 取回查询结果中的数据，每次返回一条数据，没有更多时返回 false
     * 
     * @param   string  可选值为：assoc、num、array ，默认为 assoc
     * @return  Array 
     */
    public function &rows($type='assoc') {
        if(!$this->result) return false;
        $line = false;
        switch ($type) {
            case 'assoc':
            $line = @mysql_fetch_assoc($this->result);
            break;
            case 'num':
            $line = @mysql_fetch_row($this->result);
            break;
            default:
            $line = @mysql_fetch_array($this->result);
            break;
        }

        if($line === false) {
            @mysql_free_result($this->result);
            $line = array();
        }
        return $line;
    }
}
