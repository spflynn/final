<?php 
//now print out each record
    include 'top.php';
    $queryfile = fopen("q01.sql","r");
    //$query = "SELECT `pmkNetId` FROM `tblTeachers`";
    $query = fread($queryfile,  filesize("q01.sql"));
    $info2 = $thisDatabaseReader->select($query, "", 0, 0, 2, 0, false, true);
    print '<article>';
    
    print '<aside>';
    
    $columns = 2;
    $highlight = 0; // used to highlight alternate rows
    $currentTerm=1;
    $term = 0;
    $semesterCredits=0;
    $totalCredits=0;
    $printCredits = false;
    foreach ($info2 as $rec) {

        $currentTerm=$rec['fldDisplayOrder'];
//        $highlight++;
//        if ($highlight % 2 != 0) {
//            $style = ' odd ';
//        } else {
//            $style = ' even ';
//        }
//        
        if ($term != $currentTerm) {

        if ($printCredits) print '<p> Number of Credits:'.$semesterCredits;
        if ($term%2 ==0) print '</div>';
        $totalCredits+=$semesterCredits;
        $semesterCredits=0;
        print '</div>';
        if ($term%2==0) print '<div class = year>';
        print '<div class ='.$rec['fldTerm'].'>';
        print '<h3>'.$rec['fldTerm']." ".$rec['fldYear'].'</h3>';
        print '<ol>';
        $term=$currentTerm;
        }
        else{
            $term=$currentTerm;
            $printCredits=true;
        }
                $semesterCredits+=$rec['fldNumCredits'];
                

        
        print '<li>';
        for ($i = 0; $i < $columns; $i++) {
             print "$rec[$i] ";
        }
        print '</li>';
        }

    
    print '<p> Number of Credits:'.$semesterCredits;
    // all done
    print '</ol>';
    print '</aside>';
    print '<h3 id = total> Total Number of Credits:'.$totalCredits;

    print '</article>';
    include "footer.php";
?>