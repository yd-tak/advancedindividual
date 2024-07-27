<!DOCTYPE html>
<html>
<head>
    <title>Google Cloud Speech-to-Text</title>
</head>
<body>
    <h1>Google Cloud Speech-to-Text</h1>
    <button id="record-button">Start Recording</button>
    <h2>Transcript</h2>
    <input type="hidden" id="post-url" value="<?= site_url('speech/recognize') ?>">
    <div id="transcript"></div>
</body>
    <script type="module" src="<?=base_url('assets/js/custom/audiorecord/record.js')?>"></script>
    
</body>
</html>
