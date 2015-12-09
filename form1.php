

<?php
/* the purpose of this page is to display a form to allow a poet and allow us
 * to add a new poet or update an existing poet 
 * 
 * Written By: Robert Erickson robert.erickson@uvm.edu
 
 */
print '<p>Code for Poets Form</p>';
include "top.php";
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1 Initialize variables
$update = false;
$debug=true;

// SECTION: 1a.
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1b Security
//
// define security variable to be used in SECTION 2a.
$yourURL = $domain . $phpSelf;

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1c form variables
//
// Initialize variables one for each form element
// in the order they appear on the form

    $chords= "";
    



//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1d form error flags
//
// Initialize Error Flags one for each form element we validate
// in the order they appear in section 1c.
$chordsERROR = false;
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1e misc variables
//
// create array to hold error messages filled (if any) in 2d displayed in 3c.
$errorMsg = array();
$data = array();
$data1 = array();
$dataEntered = false;

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2 Process for when the form is submitted
//
if (isset($_POST["btnSubmit"])) {
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2a Security
//
//   if (!securityCheck(true)) {
//      $msg = "<p>Sorry you cannot access this page. ";
//      $msg.= "Security breach detected and reported</p>";
//      die($msg);
//      }

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2b Sanitize (clean) data
// remove any potential JavaScript or html code from users input on the
// form. Note it is best to follow the same order as declared in section 1c.

    // I am not putting the ID in the $data array at this time
    
    
    
    $chords = htmlentities($_POST["txtChords"], ENT_QUOTES, "UTF-8"); //not in this query
    $chords ="'".$chords."'";
    print $chords;
    $data1[] = $chords;
    


//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2c Validation
//

    
    if ($chords == "") {
        $errorMsg[] = "Please enter chords separated by ,";
        $youTubeERROR = true;
    }// should check to make sure its the correct date format


//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2d Process Form - Passed Validation
//
// Process for when the form passes validation (the errorMsg array is empty)
//
    if (!$errorMsg) {
        if ($debug) {
            print "<p>Form is valid</p>";
        }

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2e Save Data
//
        
        
//        $dataEntered = false;
//        
//        try {
//            $thisDatabaseReader->db->beginTransaction();
//
//            if ($update) {
//                $query = 'UPDATE SPFLYNN_SQL.tblSongs SET ';
//            } else {
//                $query = 'INSERT INTO tblSongs SET ';
//            }
//
//            $query .= 'fldName = ?, ';
//            $query .= 'fldArtist = ?, ';
//            $query .= 'fldTab = ?, ';
//            $query .= 'fldYouTube =? ';
//
//            if ($update) {
//                $query .= 'WHERE pmkSongId = ? ';
//                $data[] = $pmkSongId;
//                print "Updating";
//                if ($_SERVER["REMOTE_USER"] == 'spflynn') {
//                    $results = $thisDatabaseWriter->update($query, $data, 1, 0, 0, 0, false, false);
//                    
//                    
//                } 
//            } else {//insert it
//                if ($_SERVER["REMOTE_USER"] == 'spflynn'){
//                    print "Inserting";
//                    $results = $thisDatabaseWriter->insert($query, $data);
//                    $primaryKey = $thisDatabaseWriter->lastInsert(); //last insert!!
//                    if ($debug) {
//                        print "<p>pmk= " . $primaryKey;
//                    }
//                }
//            }
//            print "Chords = ".$chords;
//            $check = "SELECT * FROM tblProgressions WHERE fldChords=".$chords;
//            $checker = $thisDatabaseReader->select($check, "", 1, 0, 2, 0, false, false);
//
//            if ($checker != null){//we know the progression
//                print"Progression is known Updating";
//                //we know the progression
//                $progressionId=$checker[0]['fldProgressionId'];
//                $songName="'".$songName."'";
//                $artistName="'".$artistName."'";
//                print '<p> ProgressionId ='.$progressionId.'</p>';
//                print '<p> Song Name ='.$songName.'</p>';
//                print '<p> pmk ='.$primaryKey.'</p>';
//                
//                $upd = 'UPDATE SPFLYNN_SQL.tblSongs SET fldProgressionId='.$progressionId.' ';
//                $upd .= 'WHERE pmkSongId='.$primaryKey;
//                $updater = $thisDatabaseWriter->update($upd, "", 1, 0, 0, 0, false, false);
//    
//            
//                
//                
//            }
//            else { 
//                print "/nProgression was not found- inserting new progression";
//                print_r($data1);
//                $query1 = "INSERT IGNORE INTO tblProgressions(fldChords,fldProgressionId) VALUES (".$chords.", null);";
//                $ins = $thisDatabaseWriter->insert($query1, "", 0, 0, 2, 0, false, false);
//                $progressionId=$thisDatabaseWriter->lastinsert();
//                print '<p> progressionId ='.$progressionId.'</p>';
//                print '<p> pmk ='.$primaryKey.'</p>';
//                $upd = 'UPDATE SPFLYNN_SQL.tblSongs SET fldProgressionId='.$progressionId.' ';
//                $upd .= 'WHERE pmkSongId='.$primaryKey;
//                $updater = $thisDatabaseWriter->update($upd, "", 1, 0, 0, 0, false, false);
//            }
//
//            
//            //now insert progression into tblProgressions if !exist
//
//
//            
//
//            // all sql statements are done so lets commit to our changes
//            //if($_SERVER["REMOTE_USER"]=='rerickso'){
//            $dataEntered = $thisDatabaseReader->db->commit();
//            // }else{
//            //     $thisDatabaseReader->db->rollback();
//            // }
//            if ($debug)
//                print "<p>transaction complete ";
//        } catch (PDOExecption $e) {
//            $thisDatabaseReader->db->rollback();
//            if ($debug)
//                print "Error!: " . $e->getMessage() . "</br>";
//            $errorMsg[] = "There was a problem with accpeting your data please contact us directly.";
        }
    } // end form is valid
//} // ends if form was submitted.
//#############################################################################
//
// SECTION 3 Display Form
//
?>
<article id="main">
    <?php
//####################################
//
// SECTION 3a.
//
//
//
//
// If its the first time coming to the form or there are errors we are going
// to display the form.
    if ($dataEntered) { // closing of if marked with: end body submit
        print "<h1>Record Saved</h1> ";
        $q1 = "UPDATE tblSongs";
    } else {
//####################################
//
// SECTION 3b Error Messages
//
// display any error messages before we print out the form
        if ($errorMsg) {
            print '<div id="errors">';
            print '<h1>Your form has the following mistakes</h1>';

            print "<ol>\n";
            foreach ($errorMsg as $err) {
                print "<li>" . $err . "</li>\n";
            }
            print "</ol>\n";
            print '</div>';
        }
//####################################
//
// SECTION 3c html Form
//
        /* Display the HTML form. note that the action is to this same page. $phpSelf
          is defined in top.php
          NOTE the line:
          value="<?php print $email; ?>
          this makes the form sticky by displaying either the initial default value (line 35)
          or the value they typed in (line 84)
          NOTE this line:
          <?php if($emailERROR) print 'class="mistake"'; ?>
          this prints out a css class so that we can highlight the background etc. to
          make it stand out that a mistake happened here.
         */
        ?>
        <form action="<?php print $phpSelf; ?>"
              method="post"
              id="frmRegister">
            <fieldset class="wrapper">
                <legend>Poets</legend>

                <input type="hidden" id="hidPoetId" name="hidPoetId"
                       value="<?php print $pmkSongId; ?>"
                       >
       
                <label for="txtChords" class="required">Chords
                    <input type="text" id="txtChords" name="txtChords"
                           value="<?php print $chords; ?>"
                           tabindex="102" maxlength="100" placeholder="enter chords like C,D,G"
    <?php if ($youTubeERROR) print 'class="mistake"'; ?>
                           onfocus="this.select()"
                           >
                </label>                
            </fieldset> <!-- ends contact -->
            <fieldset class="buttons">
                <legend></legend>
                <input type="submit" id="btnSubmit" name="btnSubmit" value="Submit" tabindex="900" class="button">
            </fieldset> <!-- ends buttons -->
            </fieldset> <!-- Ends Wrapper -->
        </form>
        <?php
    } // end body submit
    ?>
</article>

<?php
include "footer.php";
if ($debug)
    print "<p>END OF PROCESSING</p>";
?>
</article>
</body>
</html>