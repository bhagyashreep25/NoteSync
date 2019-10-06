<?PHP
if (isset($_GET['file'])) {
    $file = $_GET['file'];
    // $file = '/path/to/your/dir/'.$file;

    if (!file_exists($file)) { // file does not exist
        die('file not found');
    } else {
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=download.txt");
        header("Content-Type: application/text");
        header("Content-Transfer-Encoding: binary");

        // read the file from disk
        readfile($file);
    }
}
