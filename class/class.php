<?php

require dirname(__DIR__) . '/vendor/autoload.php';

function getInt(string $name, ?int $default = null) :?int{

    if(!isset($_GET[$name]))
    {
        return $default;
    }
    if(!filter_var($_GET[$name], FILTER_VALIDATE_INT))
    {
        header('location: errors.php');
        die();
    }
    return (int)$_GET[$name];

}

function e(string $data)
{
    return htmlentities($data);
}


class Text {

    public static function excerpt(string $content, int $limit = 60)
    {
        if(strlen($content) <= $limit){
            return $content;
        }
        $last_pace = strpos($content, ' ', $limit);
        return substr($content, 0, $last_pace) . '...';
    }


}




class Post {

    private $id_post;

    private $name;

    private $content;

    private $created_at;

    private $categories = [];

    private $slug;

    

    public function getName()
    {
        return $this->name;
    }

    public function getExcerpt() :?string
    {
        if ($this->content == null)
        {
            return null;
        }
        return nl2br(htmlentities(Text::excerpt($this->content,60)));
    }

    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->created_at);
    }
    public function getSlug():string
    {
        return $this->slug;
    }
    public function getID():string
    {
        return $this->id_post;
    }
    public function getContent():string
    {
        return nl2br($this->content);
    }
}




class Category{

    private $category_id;

    private $name;

    private $slug;

    public function getId():?int
    {
        return $this->category_id;
    }
    public function getName():?string
    {
        return $this->name;
    }
    public function getSlug():?string
    {
        return $this->slug;
    }
}


class PostTable{

}



class Pagination{
    
    private $pages;

    private $count;

    private $cPage;

    public function __construct(int $count){
        $this->count = $count;
    }


    public function setPages():int
    {
        $this->pages = ceil($this->count / 12);
    }

    private function getCurrentPage()
    {
        $this->cPage = getInt('page',1);
        if ($c > $this->pages)
        {
           return header('location: errors.php');
            // throw new Exception("le numero de page invalide");
        }
        // return $this->cPage;
    }

    public static function previousPage()
    {
        if($this->cPage >1 && $this->cPage <= $this->pages)
        {
            $var = $this->cPage -1 ;
           return " <a href='?page=<?={$var}?>' class='btn btn-primary'>&laquo; Page précédente</a>";
        }
    }

    public static function nextPage()
    {
        if($this->cPage >=1 && $this->cPage < $this->pages)
        {
            $var = $this->cPage -1 ;
        
            return "<a href='?page=<?={$var} ?>' class='btn btn-primary ml-0'>Page suivante &raquo;</a>";
        }
    }

}



class CreateUpdate {

    private $pdo;

    public function __construct($class)
    {
        $this->class = $class;
        $this->pdo = Connexion::getPDO();
       
    }



    public function isValidPost(string $name,string $slug, string $content) : bool 
    {
        
        if(strlen($name) < 3 || strlen($slug) < 7 || strlen($content) <10)
        {
            return false;
        }
        return true;
       
    }



    public function isValidCategory(string $name, string $slug) : bool
    {

        if(strlen($name) < 3 || strlen($slug) < 7 )
        {
            return false;
        }
        return true;
    }



    public function insertPost(string $name, string $slug, string $content):void

    {
        $faker = Faker\Factory::create('fr_FR');
        
        $this->pdo->exec("INSERT INTO post SET name = '{$name }', slug = '{$slug}', content = '{$content} ', created_at = '{$faker->date} {$faker->time}'");
        
    }






    public function insertCetegory(string $name, string $slug):void

    {
        
        $this->pdo->exec("INSERT INTO category SET name = '{$name}' , slug = '{$slug}'");
        
    }



    public function updatePost(int $id ,string $name, string $slug, string $content):void

    {

        $this->pdo->exec("UPDATE post SET name = '{$name}' , slug = '{$slug}' , content = '{$content}' WHERE id_post = '{$id}'");

    }



    public function updateCategory(int $id , string $name, string $slug):void

    {
        $this->pdo->exec("UPDATE category SET name = '{$name}' , slug = '{$slug}' WHERE category_id = $id");

    }

}
