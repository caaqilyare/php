<?php
      namespace Caaqil\Controllers;
      use Slim\Views\Twig as View;
      use Illuminate\Pagination\LengthAwarePaginator;
      use Caaqil\Models\User;
      use Caaqil\Models\Post;
      use Caaqil\Models\Cat;
      use Caaqil\Models\Products;
      use Illuminate\Database\Capsule\Manager as Munasar; 
      use Caaqil\Controllers\Controller as Controller;
      use \Psr\Http\Message\ServerRequestInterface as Request;
      use \Psr\Http\Message\ResponseInterface as Response;

        
      class HomeController extends Controller {       

          public function index($request , $response) {
            //  $this->flash->addMessage('info' , 'test message');
            // $user = $this->auth->user()->role;
           // $dbUsers = $this->db->query("SELECT * FROM post ")->fetchAll(\PDO::FETCH_ASSOC);
           $dbUsers = Munasar::select("SELECT * FROM post ");
            $page = $request->getParam('page', 1);
            $perPage = $request->getParam('perPage', 8);

              $users = new LengthAwarePaginator(
                  array_slice($dbUsers, ($page - 1) * $perPage, $perPage),
                  count($dbUsers),
                  $perPage,
                  $page,
                  ['path' => $request->getUri()->getPath(), 'query' => $request->getParams()]
              );

              return $this->view->render($response, 'home.html', compact('users'));
          }
          public function search($request , $response , $slug){
          $check =   Post::where('title', 'like', '%'.$request->getParam('search').'%')
            ->first();
            // var_dump($check);
            // die();
            if(!$check) {
                die('bad search');
            }
            //  var_dump($check);
            //   die();
        //    $dbUsers = $this->db->query("SELECT * FROM post WHERE title LIKE = '%Qatar%'")->fetchAll(PDO::FETCH_ASSOC);
            // $dbUsers = Post::where('title', 'like', '%'.$request->getParam('search').'%');
            // ->get();
            //var_dump($dbUsers);
            //die();
            //  var_dump($slug);
            //       die();
             return $response->withRedirect($this->router->pathFor('raadin',['slug' => $request->getParam('search')]));
            // $dbUsers = Post::where('title', 'like', '%'.$request->getParam('search').'%')
            // ->get();
            // var_dump($dbUsers);
            //  die();
          }
          public function raadin($request , $response , $slug){
           // $raadin = 'Waxaa raadisay waa '.$slug['slug'].' ku soo dhawoow';
              $rcheck = Post::where('title', 'like', '%'.$slug['slug'].'%')->first();
        //  $rcheck = Munasar::select("SELECT * FROM post WHERE title LIKE '$slug'");
              if(!$rcheck) {
                   echo "bad else ";
               }
            $newcheck = '%'.$slug['slug'].'%';
            $dbUsers = Munasar::select("SELECT * FROM post WHERE title LIKE '$newcheck'");
            $page = $request->getParam('page', 1);
            $perPage = $request->getParam('perPage', 3);

              $users = new LengthAwarePaginator(
                  array_slice($dbUsers, ($page - 1) * $perPage, $perPage),
                  count($dbUsers),
                  $perPage,
                  $page,
                  ['path' => $request->getUri()->getPath(), 'query' => $request->getParams()]
              );

              return $this->view->render($response, 'page/page.html', compact('users'));

        }
          public function pages($request, $response , $slug) {
          // $cat =   $request->getParam($slug);
             $cat = Cat::where('c_name', $slug)->first();
             if(!$cat) {
                 die('Bad Page');
             }
            $dbUsers = $this->db->query("SELECT * FROM post WHERE catagory = '$cat->c_name'")->fetchAll(\PDO::FETCH_ASSOC);
            $page = $request->getParam('page', 1);
            $perPage = $request->getParam('perPage', 3);

              $users = new LengthAwarePaginator(
                  array_slice($dbUsers, ($page - 1) * $perPage, $perPage),
                  count($dbUsers),
                  $perPage,
                  $page,
                  ['path' => $request->getUri()->getPath(), 'query' => $request->getParams()]
              );

              return $this->view->render($response, 'page/page.html', compact('users'));
          }
  }
  