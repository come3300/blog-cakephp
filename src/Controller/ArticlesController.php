<?php

namespace App\Controller;

class ArticlesController extends AppController 
{

  public function initialize()
  {
    parent::initialize();

    $this->loadComponent('Flash'); // Include the FlashComponent
  }

  
  public function index() 
  
  { $articles=$this->Articles->find('all');
    $this->set(compact('articles'));
  }

  public function view($id = null)
    {
        $article = $this->Articles->get($id);
        $this->set(compact('article'));
    }

  public function add()
  {
    $article = $this->Articles->newEntity();
    if ($this->request->is('post')) {
      // 3.4.0 より前は $this->request->data() が使われました。
      $article = $this->Articles->patchEntity($article, $this->request->getData());
      if ($this->Articles->save($article)) {
        $this->Flash->success(__('Your article has been saved.'));
        return $this->redirect(['action' => 'index']);
      }
      $this->Flash->error(__('Unable to add your article.'));
    }
    $this->set('article', $article);
    }
  }