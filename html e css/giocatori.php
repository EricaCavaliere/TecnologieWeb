<?php
    
    //compito per casa: inserire i giocatori. Ho bisogno di una form per poter anche inserire il giocatore, cioè creare la pagina dove inserisco manualmente il giocatore.

    require_once "..".DIRECTORY_SEPARATOR."connessione.php";

    $paginaHTML = file_get_contents("squadra_php.html");

    use DB\DBAccess;

    $connessione = new DBAccess();
    $stringaGiocatori = "";
    $giocatori="";

    $connOk = $connessione->openDBConnection();

    if($connOk){
        $giocatori = $connessione->OpenDBConnection();
        $connessione->closeConnection();

        if($giocatori != null){
            $stringaGiocatori .= '<dl id = "giocatori">';
            foreach($giocatori as $giocatore){
                //creare i vari dt e dd
            
                $stringaGiocatori .= "<dt>".$giocatore['nome'];
                if($giocatore['capitano']){
                    $strigaGiocatori .= " - <em>Capitano</em>";
                }
                $stringaGiocatori .="</dt>".'<dd><img src="'.$giocatore['immagine'].'" alt="" />'.'<dl class="giocatore"> <dt>Data di nascita</dt>'.'<dd>'.$giocatore['dataNascita'].' <dd>'.'<dt>Luogo</dt>'.'<dd>'.$giocatore['luogo'].'</dd>'.'<dt>Squadra</dt>'…… //devo continuare a riempire seguendo il php e modificando i dati con php…

                if($giocatore['ruolo']!='Libero'){
                    $stringaGiocatori .= '<dt>Punti totali</dt>';
                }else{
                    $stringaGiocatori .= '<dt>Ricezioni</dt>';
                }
                $stringaGiocatori .= '<dd>' .$giocatore['punti']. '</dd>';
                if($giocatore['riconoscimenti']){}
            }
            $stringaGiocatori .= '</dl>';
        }else{
            $stringaGiocatori = "<p>Nessun giocatore presente.</p>";
        }
    }else{
        $stringaGiocatori = "<p>I sistemi sono momentaneamente fuori servizio, ci scusiamo per il disagio.</p>";
    }

    echo str_replace("<listaGiocatori />",$stringaGiocatori, $paginaHTML);
?>

