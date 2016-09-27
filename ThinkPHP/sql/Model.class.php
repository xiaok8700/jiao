<?PHP
include_once(dirname(__FILE__) . '/Db.class.php');
class Model extends Db
{

    private $per   = 15;
    private $count = 0;
    public  $key   = 'id';

    public function __construct($name) {
        parent::__construct();
        $this->table($name);
    }
    
    public function get_list($per=15, $page=1) {
        $this->per = $per;
        $rs = $this->limit($per, $page);
        return $this->get_all();
    }

    public function get_all() {
        $rows = array();
        $rs = $this->select();
        while($line = $rs->rows())$rows[]=$line;
        return $rows;
    }

    public function get_one($key = NULL) {

        if(!is_null($key)) $this->where("`{$this->key}` = '$key'");

        $rows = array();
        $rs = $this->limit(1)->select();
        if($rs)$rows = $rs->rows();
        return $rows;
    }

    public function get_count() {
        if(!$this->param) {
            $this->param = end($this->past);
            unset($this->param['limit']);
        }
        $rs = $this->field('count(*) as count')->select();
        $count = 0;
        
        if($rs) {
            $rows = $rs->rows();
            $count = (int)$rows['count'];
        }
        
        $this->count = $count;
        return $count;
    }

    public function edit($post) {
        if(!is_array($post)) return false;
        
        $key = NULL;
        if(!empty($post[$this->key])) $key = $post[$this->key];
        if(isset($post[$this->key]))  unset($post[$this->key]);

        if($key) {
            if(empty($this->where))$this->where("`{$this->key}`='$key'");
            $rs = $this->update($post);
        } else {
            $rs = $this->insert($post);
        }
        return $rs;
    }

    public function del($keys) {
        if(!$keys) return false;
        $ids = array();
        $in  = '';
        if(is_array($keys)) {
            foreach($keys as $v) {
                if(!empty($v)) $ids[] = (int)$v;
            }
            $in = implode(',', $ids);
            $this->where("`{$this->key}` in($in)");
        } else {
            if($keys)$in = (int)$keys;
            $this->where("`{$this->key}` = '$in'");
        }
        if(!$in) {
            $this->where("");
            return false;
        }
        $rs = $this->delete();
        return $rs;
    }
}