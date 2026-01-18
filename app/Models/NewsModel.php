<?php
namespace App\Models;
use CodeIgniter\Model;

class NewsModel extends Model {
    protected $table = 'news';
    /**
     * @param false | string $slug
     * 
     * @return array | null
     */

    public function getNews($slug = false) {
        if($slug===false) {
            $sql = $this->select('news.*, categories.category');
            $sql = $this->join('categories', 'news.id_category = categories.id');
            $sql = $this->findAll();
            return $sql;
        }

        $sql = $this->select('news.*, categories.category');
        $sql = $this->join('categories', 'news.id_category = categories.id');
        $sql = $this->where(['slug' => $slug])->first();
        return $sql;
    }

    public function getNewsByCategory($id_category) {
        $sql = $this->select('news.*, categories.category');
        $sql = $this->join('categories', 'news.id_category = categories.id');
        $sql = $this->where(['id_category' => $id_category])->findAll();
        return $sql;
    }

    public function headingNews() {
        $sql = $this->select('news.*, categories.category');
        $sql = $this->join('categories', 'news.id_category = categories.id');
        $sql = $this->first();
        return $sql;
    }

    public function lastestNews() {
        $sql = $this->select('news.*, categories.category');
        $sql = $this->join('categories', 'news.id_category = categories.id');
        $sql = $this->findAll(2,1);
        return $sql;
    }
}