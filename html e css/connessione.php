<?php
    namespace DB;
    class DBAccess {
        private const HOST_DB = "127.0.0.1";
        private const DATABASE_NAME = "ecavalie";
	    private const USERNAME = "ecavalie";
	    private const PASSWORD = "kie2eevateerooCh";

	    private $connection;

        public function openDBconnection(){
            mysqli_report(MYSQLI_REPORT_ERROR);
            $this->connection = mysqli_connect(DBAccess::HOST_DB, DBAccess::USERNAME, DBAccess::PASSWORD, DBAccess::DATABASE_NAME);
            if(mysql_connect_errno()){
		        return false;
            }else{
	            return true;
            }
        }

        public function getList(){
            $query = "SELECT * FROM giocatoriORDER BY ID ASC";
            $queryResult = mysqli_master_query($this->connection, $query) or die("Errore in DBconnection: ".mysqli_error($this->connection));
            if(mysqli_num_rows($queryResult)==0){
                return null;
            }else{
                $result = array();
                while ($riga = mysqli_fetch_assoc($queryresult)){
                    array_push($result, $riga);
                }
                $queryResult->free();
                return $result;
            }
        }
        
        public function insertNewPlayer($nome, $capitano, $dataNascita, $luogo, $squadra, $ruolo, $altezza, $maglia, $magliaNazionale, $punti, $riconoscimenti, $note){
            $queryString = "INSERT INTO giocatori (nome, capitano, dataNascita, luogo, squadra, ruolo, altezza, maglia, magliaNazionale, punti, riconoscimenti, note) VALUES (\"$nome\", $capitano, \"$dataNascita\", \"$luogo\", \"$squadra\", \"$ruolo\", $altezza, $maglia, $magliaNazionale, $punti, \"$riconoscimenti\", \"$note\")";
        
            $queryOK = mysqli_query($this->connection, $queryString) or die(mysqli_error(this->connection));
        

            //modo1
            //return  queryOk; //essendo un “booleano” ritornerà false se queryOk=0, altrimenti restituirà true;

            //modo2
            if(mysqli_affected_rows($this->connection)>0){
                return true;
            }else{
                return false;
            }
        }

        public function deletePlayer($id){
            $queryString = "DELETE FROM giocatori WHERE ID=$id";
            $queryOK = mysqli_query($this->connection, $queryString) or die(mysqli_error(this->connection));
            
            //modo1
            //return  queryOk; //essendo un “booleano” ritornerà false se queryOk=0, altrimenti restituirà true se è maggiore;

            //modo2
            if(mysqli_affected_rows($this->connection)>0){
                return true;
            }else{
                return false;
            }
        }

        public function closeConnection(){
            mysqli_close($this->connection);
        }
    }
    //Nella pagina della squadra, togliamo la lista di definizione dei giocatori e inseriamo un “segnaposto”: <listagiocatori />e salvare il file come squadra.php
?>

