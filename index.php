
<?php
/* %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
 * the purpose of this page is to display a list of songs, admin can edit
 * 
 * Written By: Sean Flynn
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

if (isset($_GET["chords"])){
    $chords=$_GET["chords"];
    print $chords;
    $query .= "WHERE fldChords ="."'".$chords."'";
    $songs = $thisDatabaseReader->select($query, "", 1, 0, 2, 0, false, false);
}
else{
    $songs = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);
}
$debug=false;

if ($debug) {
    print "<pre>";
    print_r($songs);
    print "</pre>";
}

    print '<table>';
    
    $columns = 6;

    $highlight = 0; // used to highlight alternate rows
    if ($songs) {foreach ($songs as $song) {
        $firstpass=true;
        $highlight++;
        if ($highlight % 2 != 0) {
            $style = ' odd ';
        } else {
            $style = ' even ';
        }
        
        print '<tr class="' . $style . '">';


        for ($i = 1; $i < $columns; $i++) {
                    if ($admin and $firstpass) {
        print '<td><a href="form.php?id=' . $song["pmkSongId"] . '">[Edit]</a> ';
        print '<a href="form.php?id=' . $song["pmkSongId"] .'& delete=true'. '">[Delete]</a></td>  ';
        $firstpass=false;
        }
        print '<td>' . $song[$i] . '</td>';
        
        if ($i===2){
            print '<td><a href=index.php?chords=' . $song[$i+1] .'>Chords  </a></td>  ';
            $i++;
        }
        if ($i===3){
            print '<td><a href=' . $song[$i+1] .'>Tab  </a></td>  ';
            $i++;
        }
        if ($i===4){
            print '<td><a href=' . $song[$i+1] .'>Youtube</a></td>  ';
            $i++;
        }

 
        
    }
    print '</tr>';
    }
    }
    // all done
    print '</table>';

print "</article>";
include "footer.php";
?>