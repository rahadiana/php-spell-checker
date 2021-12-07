<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SpellCheker Bahasa Indonesia | Belajar IT</title>
    <link rel="stylesheet" href="css/pure-min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous" />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.4/tinymce.min.js' referrerpolicy="origin"></script>
  <script>
  tinymce.init({
    selector: '.teksperbaikan',
    readonly: 1,
    menubar: false,
    statusbar: false,
    toolbar: false
  });
  </script>
</head>
<body style="margin:0 auto; width: 90%; padding: 10px;">
    <h2>SpellCheker Bahasa Indonesia | Belajar IT</h2>
    <form class="pure-form" style="width:100%" method="post">
        <fieldset class="pure-group">
            <textarea style="height: 100px" name="kalimat" class="pure-input-1-2 .textarea"></textarea>
        </fieldset>
        <button type="submit" name="submit" class="pure-button pure-input-1-2 pure-button-primary">Cek kalimat</button>
    </form>
    <?php

include_once "Translate.php";

$kata=$_POST['kalimat'];
$SourceLang ='id';
$transLang= 'id';
$data= GetTranslate($SourceLang,$transLang,$kata);

//echo $data;
$DecodeJson = json_decode($data,true);

    if($kata==null){
        //kosong
    }elseif($DecodeJson["spell"]["spell_html_res"]==null){
        echo '
        <h2>Teks Input</h2>
        <textarea style="height: 100px" name="kalimat" class="pure-input-1-2 teksperbaikan">'.$DecodeJson["sentences"][0]["trans"].'</textarea>
        ';  
    }else{
        echo '
        <h2>Teks Input</h2>
        <textarea style="height: 100px" name="kalimat" class="pure-input-1-2 teksperbaikan">'.$DecodeJson["sentences"][0]["trans"].'</textarea>
        <pre></pre>
        <h2>Teks Perbaikan</h2>
        <textarea style="height: 100px" name="kalimat" class="pure-input-1-2 teksperbaikan">'.$DecodeJson["spell"]["spell_html_res"].'</textarea>
        '
?>
        <div id="SecretInfo" style="display: none;">
            <?php echo $DecodeJson["spell"]["spell_res"]; ?>
        </div>
        <pre></pre>
        <button type="button" id="btnCopy" name="submit" class="pure-button pure-input-1-2 pure-button-primary">Copy Teks</button>
        <script type="text/javascript">
            var $body = document.getElementsByTagName('body')[0];
            var $btnCopy = document.getElementById('btnCopy');
            var SecretInfo = document.getElementById('SecretInfo').innerHTML;
            var copyToClipboard = function(SecretInfo){
                var $tempInput = document.createElement('INPUT');
                $body.appendChild($tempInput);
                $tempInput.setAttribute('value',SecretInfo)
                $tempInput.select();
                document.execCommand('copy');
                $body.removeChild($tempInput);
            }
            $btnCopy.addEventListener('click',function(ev){
                copyToClipboard(SecretInfo);
                alert("Text Tercopy");
            });
        </script>
        <?php
            ;
    }

            ?>
 <pre></pre>
 <div class="footer" style="background-color: #ffffaa;padding:3px;width:100%; ">SpellCheker Bahasa Indonesia |  <a href="https://youtu.be/4l6ejCu3b9M" target="_blank">Belajar IT</a>.  <i class="fab fa-github"></i> <a href="https://github.com/rahadiana/php-spell-checker" target="_blank">Github</a>.</div>
</body>
</html>
