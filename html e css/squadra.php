<?php
	require_once "connessione.php";
	$paginaHTML = file_get_content("nuovoGiocatore.html");
	use DB\DBAccess;
	
	$tagPermessi = '<em><strong><ul><li><span>'
	
	$nome ='';
	$capitano ='';
	$dataDiNascita ='';
	$messaggiPerForm ='';

    function pulisciInput($value){
        $value = trim($value);
        $value = strip_tags($value);
        $value = htmlentities($value);
        return $value;
    }

    function pulisciNote($value){
        global $tagPermessi;

        $value = trim($value);
        $value = strip_tags($value, $tagPermessi);
        return $value;
    }

    if(isset($_POST['submit'])){
        $nome = pulisciInput($_POST['nome']);
        //faccio una lista degli errori presenti
        if(strlen($nome)==0){
            $messaggiPerForm .= '<li>Nome e cognome non inseriti</li>';
        }else{
            if(preg_match("/\d/",$nome)){//controllare questo /\d/
                $messaggiPerForm .= '<li>Nome e cognome non possono contenere numeri</li>';
            }
        }

        $capitano = pulisciInput($_POST['capitano']);

        $dataDiNascita = pulisciInput($_POST['dataNascita']);
        if(strlen($dataNascita)==0){
            
        }else{
            if(!preg_match("/\d{4}\-\d{2}\-\d{2}/",$dataNascita)){
                $messaggiPerForm .= '<li>La data di nascita nel formato non corretto</li>';
            }
        }

        //dopo aver fatto tutti i controlli

        if($messaggiPerForm==""){
            $connessione = new DBAccess();
            $connOK = $connessione->openDBConnection():
            if ($connOK){
                $queryOK = $connessione->insertNewPlayer($nome, $capitano, $dataNascita, $luogo, $squadra, $ruolo, $altezza, $maglia, $magliaNazionale, $punti, $riconoscimenti, $note);
                if($queryOK){
                    $messaggiPerForm = '<div id="greetings"><p>Inserimento avvenuto con successo.</p></div>';
                }else{
                    $messaggiPerForm = '<div id="messageErrors"><p>problema nell\'inserimento dei dati, controlla se hai usato caratteri speciali.</p></div>';
                }
            }else{
                $messaggiPerForm = '<div id="messageErrors"><p>I nostri sistemi sono al momento non funzionanti, ci scusiamo per il disagio.</p></div>';
            }
        }else{
            $messaggiPerForm = '<div id="messageErrors"><ul>' . $messaggiPerForm . "</ul></div>";
        }

    }else{
        echo $paginaHTML; //attenzione, facendo così, stampa i tag "segnaposto"
    }

    //con queste 3 righe, si toglie il ramo else dell' if appena controllato
    $paginaHTML = str_replace('<messaggiForm />',$,$paginaHTML);
    $paginaHTML = str_replace('<valoreNome />',$nome,$paginaHTML);
    $paginaHTML = str_replace('<valData />',$dataDiNascita,$paginaHTML);
    $paginaHTML = str_replace('<valLuogo />',$luogo,$paginaHTML);

    echo $paginaHTML;
?>
