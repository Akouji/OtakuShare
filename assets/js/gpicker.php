<?php require_once(realpath($_SERVER['DOCUMENT_ROOT']) . '/library/config/config.php');
header('Content-Type: application/javascript');
header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Connection: close");
$g_token = base64_decode($_GET['t']);
?>
var developerKey="<?= $google['developer_key'];?>",clientId="<?= $google['client_id'];?>",oauthToken="<?= $g_token;?>",pick_id=[];
var scope = ['https://www.googleapis.com/auth/drive.file'];
var max=0,pickerApiLoaded = false;       
function onApiLoad() {
    gapi.load('picker', {'callback': onPickerApiLoad});
}
function onAuthApiLoad() {
    window.gapi.auth.authorize(
    {'client_id': clientId,'scope': scope,'immediate': false}, handleAuthResult);
}
function onPickerApiLoad() {
    pickerApiLoaded = true;createPicker();
}
function handleAuthResult(authResult) {
    if(authResult && !authResult.error) {
        oauthToken = authResult.access_token;createPicker();
    }
}
function createPicker() {
if (pickerApiLoaded && oauthToken) {
    var docsView = new google.picker.DocsView()
          .setIncludeFolders(true)
          .setOwnedByMe(true);
    var picker = new google.picker.PickerBuilder()
    .enableFeature(google.picker.Feature.MULTISELECT_ENABLED)
    .addView(docsView)
    .addViewGroup(
        new google.picker.ViewGroup(google.picker.ViewId.DOCS)
        .addView(google.picker.ViewId.DOCUMENTS)
        .addView(google.picker.ViewId.PRESENTATIONS))
        .setOAuthToken(oauthToken)
        .setDeveloperKey(developerKey)
        .setCallback(pickerCallback)
        .build();picker.setVisible(true);
    }
}
function pickerCallback(data) {
    var url = 'nothing',name = 'nothing';
    if (data[google.picker.Response.ACTION] == google.picker.Action.PICKED) {
        var doc = data[google.picker.Response.DOCUMENTS];
        url = doc[google.picker.Document.URL];
        let output='';
        doc.forEach(function(file) {
            max++;
            if(max>25) {
                swal('Oow!','Maximum 25 files','warning');
                return max=15;
            }//console.log(file.id);
            output+=`<div class="text-dark files" g-id="${file.id}"><img src="${file.iconUrl}"><small><a class="nameFile"> ${file.name} </a></small><small class="statFile"></small><button onclick="delPicker(this)" type="button" class="close">&times;</button><hr/></div>`;
            pick_id.push(file.id);
        }); //console.log(pick_id);
        document.getElementById('upload-picker').innerHTML=output;
    }
}
function delPicker(id) {
    var dad = $(id); dad.parent().remove(); max--;
    //console.log(pick_id);
}