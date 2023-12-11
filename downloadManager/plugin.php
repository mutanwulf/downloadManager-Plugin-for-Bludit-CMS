<?php
class downloadManager extends Plugin
{

    public function init()
    {
        $this->dbFields = array(
            'class' => '',
            'titleDM' => '',
            'target' => '',

        );
    }


    public function form()
    {
        include($this->phpPath() . 'PHP/buttonOption.php');
    }


    public function adminController()
    {


        $targetDir = PATH_CONTENT . 'downloadManagerFolder/';


        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755);
            file_put_contents($targetDir . '.htaccess', 'Allow from all');
        };

        // Przygotowanie odpowiedzi JSON
        $response = array();


        if (!empty($_FILES)) {
            $tempFile = $_FILES['file']['tmp_name'];
            $originalFileName = $_FILES['file']['name'];
            $targetFile = $targetDir . $originalFileName;

            // Sprawdzanie, czy plik o danej nazwie już istnieje
            $counter = 1;
            while (file_exists($targetFile)) {
                $fileName = pathinfo($originalFileName, PATHINFO_FILENAME) . '_' . $counter . '.' . pathinfo($originalFileName, PATHINFO_EXTENSION);
                $targetFile = $targetDir . $fileName;
                $counter++;
            }

            if (move_uploaded_file($tempFile, $targetFile)) {
                $response['message'] = "Plik został przesłany pomyślnie.";
                $response['status'] = "success";
                $response['fileName'] = $fileName; // Zwracanie nowej nazwy pliku
            } else {
                $response['message'] = "Wystąpił błąd podczas przesyłania pliku.";
                $response['status'] = "error";
            }
        } else {
            $response['message'] = "Brak przesłanego pliku.";
            $response['status'] = "error";
        }

        if (isset($_POST['deleteFile'])) {

            unlink($targetDir . $_POST['nameFile']);
        }
    }

    public function adminView()
    {

        global $security;
        $tokenCSRF = $security->getTokenCSRF();

        if (isset($_GET['upload'])) {
            include($this->phpPath() . 'PHP/uploader.php');
        } else {
            include($this->phpPath() . 'PHP/downloadManager.php');
        }
    }

    public function adminSidebar()
    {
        $pluginName = Text::lowercase(__CLASS__);
        $url = HTML_PATH_ADMIN_ROOT . 'plugin/' . $pluginName;

        $html = '<a id="current-version" class="nav-link" href="' . $url . '?upload">DM Upload 🚀</a>';
        $html .= '<a id="current-version" class="nav-link" href="' . $url . '">DownloadManager 🚀</a>';
        return $html;
    }


    public function siteHead()
    {

        function dmShow($link)
        {
            $dm = new downloadManager();


            return '<a href="' . DOMAIN . HTML_PATH_CONTENT . 'downloadManagerFolder/' . $link[1] . '" class="' . $dm->db['class'] . '" target="' . $dm->db['target'] . '">' . $dm->db['titleDM'] . '</a>';
        }
    }



    public function pageBegin()
    {

        global $page;

        $newcontent = preg_replace_callback(
            '/\\[% dm="(.*)" %\\]/i',
            "dmShow",
            $page->content()
        );


        global $page;
        $page->setField('content', $newcontent);
    }
}
