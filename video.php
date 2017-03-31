<?php
class Video {
    /*Classe representant une video de la bdd
    Les fonctions disponibles sont :  
     * toString
     * getVideo(bdd,nom de la vidéo)
     * insererVideo(bdd,nom,question, bonne réponse, reponse fausse1,reponse fausse2  ,reponse fausse3)      */
    public $id;
    public $nom;
    public $question;
    public $right_answer;
    public $wrong_answer1;
    public $wrong_answer2;
    public $wrong_answer3;
 
    public function __toString() {
        return '[video : '.$this->nom.'] ';
    }
    
    public static function getVideoWithID($dbh, $id) {
        $query = "SELECT * FROM `video` WHERE id = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Video');
        $sth->execute(array("$id"));
        $video = $sth->fetch();
        // $sth : boolean qui dit si ca a marché ou pas
        $sth->closeCursor();
        return ($sth)? $video: null;
    }
    public static function getVideo($dbh, $nom) {
        $query = "SELECT * FROM `video` WHERE nom = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Video');
        $sth->execute(array("$nom"));
        $video = $sth->fetch();
        // $sth : boolean qui dit si ca a marché ou pas
        $sth->closeCursor();
        return ($sth)? $video: null;
    }
    
    public static function insererVideo($dbh, $nom, $question, $right_answer,$wrong_answer1,$wrong_answer2,$wrong_answer3) {
        if (Video::getVideo($dbh, $nom) == null){
            $sth = $dbh->prepare("INSERT INTO `video` (`nom`, `question`, `right_answer`,`wrong_answer1`,`wrong_answer2`,`wrong_answer3`) VALUES(?,?,?,?,?,?)");
            $sth->execute(array($nom, $question, $right_answer,$wrong_answer1,$wrong_answer2,$wrong_answer3));
            return TRUE;
        }
        else{
            return FALSE;
        }   
    }
    
    public static function testerReponse($dbh,$id,$reponse) {
        $video=Video::getVideoWithID($dbh, $id);
        return $reponse==$video->right_answer;
    }
    

    public static function deleteUser($dbh,$nom){
        $query="DELETE FROM `video` WHERE `nom`=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Video');
        $sth->execute(array("$nom"));
    }
    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

