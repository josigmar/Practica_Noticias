<?php
namespace App\Controllers;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\NewsModel;

class NewsBackend extends BaseController {
    public function index() {
        $model = model(NewsModel::class);
        $data = [
            'news_list' => $model->getNews(),
            'title' => 'News archive'
        ];

        return view ('backend/templates/header')
            . view('backend/news/index', $data)
            . view ('backend/templates/footer');
    }

    public function show($slug = null) {
        $model = model(NewsModel::class);

        $data['news'] = $model->getNews($slug);

        if ($data['news'] === null) {
            throw new PageNotFoundException('Cannot find the news item: ' . $slug);
        }

        $data['title'] = $data['news']['title'];

        return view ('backend/templates/header', $data)
            . view('backend/news/view')
            . view ('backend/templates/footer');
    }
}
