<?php
namespace App\Controllers;
use App\Models\CategoriesModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\NewsModel;

class NewsBackend extends BaseController {
    public function index() {
        $session = session(); 
        if (empty($session->get('user'))) { 
            return redirect()->to(base_url('admin')); 
        }
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

    //Mostrar formulario de inserción de noticias
    public function new() {
        helper('form');

        $model_cat = model(CategoriesModel::class);
        if ($data['category'] = $model_cat->findAll()) {
            return view ('backend/templates/header', ['title' => 'Create a news item'])
                . view('backend/news/create', $data)
                . view ('backend/templates/footer');
        }
    }

    //Insertar noticia 
    public function create() { 
        helper('form'); 
        
        $data = $this->request->getPost(['title', 'body','id_category']);//name del form
        
        //Comprobar reglas de validación de los datos del formulario
        if (! $this->validateData($data, [ 
            'title' => 'required|max_length[255]|min_length[3]', 'body'  => 'required|max_length[5000]|min_length[10]', 'id_category' => 'required', 
        ])) { 
            //Si la validación falla, volvemos al formulario
            return $this->new(); 
        } 
        
        //Obtenemos datos validados 
        $post = $this->validator->getValidated(); 
        
        $model = model(NewsModel::class); 

        //Insertar en la tabla News
        $model->save([ 
            'title' => $post['title'], 
            'slug'  => url_title($post['title'], '-', true), 
            'body'  => $post['body'], 
            'id_category' => $post['id_category'], 
        ]); 
        
        return redirect()->to(base_url('backend'));
    }

    //Mostrar el formulario de edición de noticias
    public function update($id) { 
        helper('form'); 
        
        if ($id == null) { 
            throw new PageNotFoundException('Cannot update the item'); 
        } 
        
        $model = model(NewsModel::class); 
        
        if($model->where('id', $id)->find()) { //=find($id)
            $data = [ 
                'news' => $model->where('id', $id)->first(), 
                'title' => 'Update Item', 
            ]; 
        } else { 
            throw new PageNotFoundException('Selected item not found in DB'); 
        } 
        
        $model_cat = model(CategoriesModel::class); 
        
        if($data['category'] = $model_cat->findAll()) { 
            return view('backend/templates/header', ['title' => 'Update news item']) 
                . view('backend/news/update', $data) 
                . view('backend/templates/footer'); 
        } 
    } 

    //Editar noticia 
    public function updatedItem($id) { 
        helper('form'); 
        
        $data_form = $this->request->getPost(['title', 'body','id_category']); 
        
        if (! $this->validateData($data_form, [ 
            'title' => 'required|max_length[255]|min_length[3]', 'body'  => 'required|max_length[5000]|min_length[10]', 'id_category' => 'required' 
        ])) { 
            return $this->update($id); 
        } 
        
        $post = $this->validator->getValidated(); 
        
        $model = model(NewsModel::class); 
        
        $model->save([ 
            'id' => $id, 
            'title' => $post['title'], 
            'slug'  => url_title($post['title'], '-', true), 
            'body'  => $post['body'], 
            'id_category' => $post['id_category'] 
        ]); 
        return redirect()->to(base_url('backend')); 
    } 
    
    //Eliminar noticia
    public function delete($id) {
         if ($id == null) { 
            throw new PageNotFoundException('Cannot delete the item'); 
        } 
        
        $model = model(NewsModel::class); 
        
        if ($model->find($id)) {
            $model->delete($id); 
        } else { 
            throw new PageNotFoundException('Selected item not found in DB'); 
        } 
        
        return redirect()->to(base_url('backend')); 
    }
}