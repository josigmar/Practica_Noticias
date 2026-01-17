<?php
namespace App\Controllers;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\NewsModel;
use App\Models\CategoriesModel;

class News extends BaseController {
    public function index($id_category = null) {
        $model = model(NewsModel::class);

        if ($id_category == null) {
            $data = [
                'news_list' => $model->getNews(),
                'title' => 'News archive'
            ];
        } else {
            $data = [
                'news_list' => $model->getNewsByCategory($id_category),
                'title' => 'News archive'
            ];
        }        

        $model_cat = model(CategoriesModel::class);
        $data['categories'] = $model_cat->findAll();

        return view ('templates/header', $data)
            . view('news/index')
            . view ('templates/footer');
    }

    public function show($slug = null) {
        $model = model(NewsModel::class);

        $data['news'] = $model->getNews($slug);

        if ($data['news'] === null) {
            throw new PageNotFoundException('Cannot find the news item: ' . $slug);
        }

        $data['title'] = $data['news']['title'];

        $model_cat = model(CategoriesModel::class);
        $data['categories'] = $model_cat->findAll();

        return view ('templates/header', $data)
            . view('news/view')
            . view ('templates/footer');
    }
}
