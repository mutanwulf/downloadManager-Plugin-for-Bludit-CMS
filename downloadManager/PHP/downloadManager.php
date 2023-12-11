<div class="row justify-content-between align-items-center py-3 border-bottom mb-4">
    <h3>Download Manager 🚀</h3>

    <a class="btn btn-primary btn-sm" href="<?php echo DOMAIN_ADMIN; ?>configure-plugin/downloadManager">Button settings</a>


</div>
<style>
    .dm-list {
        margin: 100px 0;
        display: block;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .dm-list li {
        display: grid;
        grid-template-columns: 50px 1fr 50px 100px 80px;
        align-items: center;
        padding: 5px 0;
        border-bottom: solid 1px #ddd;
        gap: 10px;
    }

    .dm-list .thumb {
        width: 40px;
        height: 40px;
        background: #000;
        margin-right: 10px;
    }
</style>

<ul class="dm-list">

    <?php foreach (glob(PATH_CONTENT . 'downloadManagerFolder/*.*') as $file) {

        $basename = pathinfo($file)['basename'];
        $ext = pathinfo($file)['extension'];

        echo '<li><div class="thumb"';

        if ($ext === 'jpg' || $ext === 'webp' || $ext === 'gif' || $ext === 'png' || $ext === 'jpeg' || $ext === 'bmp') {
            echo 'style="background:url(' . DOMAIN . HTML_PATH_CONTENT . 'downloadManagerFolder/' . $basename . ');background-size:cover;"';
        };

        echo '></div> ' . $basename . ' <button class="btn btn-primary btn-sm copy-link" data-link="' . DOMAIN . HTML_PATH_CONTENT . 'downloadManagerFolder/' . $basename . '">Copy</button><button class="btn btn-primary btn-sm shortcode" data-shortcode="' . $basename . '">shortcode</button>
        
        <form class="d-flex" method="post">
        <input type="hidden" id="jstokenCSRF" name="tokenCSRF" value="' . $tokenCSRF . '">
        <input  type="hidden" name="nameFile" value="' . $basename . '">
        <button class="btn btn-sm btn-danger" name="deleteFile" type="submit" onclick="return confirm(`Are you sure you want to delete this item?`);">Delete</button></form>
        </li>';
    }; ?>

</ul>

<script>
    document.querySelectorAll('.copy-link').forEach(x => {


        x.addEventListener('click', (e) => {
            e.preventDefault();
            const dataLink = x.getAttribute('data-link');
            navigator.clipboard.writeText(dataLink);
            alert("Link copied to clipboard");
        })


    })


    document.querySelectorAll('.shortcode').forEach(x => {


        x.addEventListener('click', (e) => {
            e.preventDefault();
            const dataLink = x.getAttribute('data-shortcode');
            navigator.clipboard.writeText('[% dm="' + dataLink + '" %]');
            alert("shortcode copied to clipboard");
        })


    })
</script>

<br>
<script type='text/javascript' src='https://storage.ko-fi.com/cdn/widget/Widget_2.js'></script>
<script type='text/javascript'>
    kofiwidget2.init('you like it? Buy me coffe', '#e02828', 'I3I2RHQZS');
    kofiwidget2.draw();
</script>