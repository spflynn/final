<?php /* //now print out each record
    include 'top.php';
    $queryfile = fopen("q01.sql","r");
    //$query = "SELECT `pmkNetId` FROM `tblTeachers`";
    $query = fread($queryfile,  filesize("q01.sql"));
    $info2 = $thisDatabaseReader->select($query, "", 1, 0, 2, 0, false, true);
    print '<article>';
    print '<aside>';
    print '<table>';
    
    $columns = 7;

    $highlight = 0; // used to highlight alternate rows
    foreach ($info2 as $rec) {
        $highlight++;
        if ($highlight % 2 != 0) {
            $style = ' odd ';
        } else {
            $style = ' even ';
        }

        print '<tr class="' . $style . '">';
        for ($i = 0; $i < $columns; $i++) {
            print '<td>' . $rec[$i] . '</td>';
        }
        print '</tr>';
    }

    // all done
    print '</table>';
    print '</aside>';

    print '</article>';
    include "footer.php";
 * 
 */
?>

<?php
/* %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
 * the purpose of this page is to display a list of poets, admin can edit
 * 
 * Written By: Robert Erickson robert.erickson@uvm.edu
 */
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
$admin = true;
include "top.php";

print "<article>";
// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
// prepare the sql statement


$query  = "SELECT pmkSongId, fldName, fldArtist, tblProgressions.fldChords, fldTab, fldYouTube ";
$query .= "FROM tblSongs ";
$query .= "JOIN tblProgressions on tblProgressions.fldProgressionId = tblSongs.fldProgressionId ";

$debug=true;
if ($debug)
    print "<p>sql " . $query;

$songs = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);

if ($debug) {
    print "<pre>";
    print_r($songs);
    print "</pre>";
}

// %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
// print out the results
print "<ol>\n";

foreach ($songs as $song) {
    

    print "<li>";
    if ($admin) {
        print '<a href="form.php?id=' . $song["pmkSongId"] . '">[Edit]</a> ';
        print '<a href="form.php?id=' . $song["pmkSongId"] .'& delete=true'. '">[Delete]</a> ';
    }
    print $song['fldName'].' by ' ;
    print $song['fldArtist'];
    print $song['fldChords'];
    print '<a href=' . $song["fldTab"] . '">Tab</a> ';
    print '<a href=' . $song["fldYouTube"] . '">YouTube</a> ';
    
}
print "</ol>\n";

print "</article>";
include "footer.php";
?>