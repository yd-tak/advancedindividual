<!DOCTYPE html>
<html>
<head>
    <title>Google Cloud Speech-to-Text</title>
</head>
<body>
    <h1>Google Cloud Speech-to-Text</h1>
    <button id="start">Start Recording</button>
    <button id="stop">Stop Recording</button>
    <h2>Transcript</h2>
    <div id="transcript"></div>

    <script>
        let mediaRecorder;
        let audioChunks = [];

        document.getElementById('start').addEventListener('click', async () => {
            const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
            mediaRecorder = new MediaRecorder(stream);

            mediaRecorder.ondataavailable = event => {
                audioChunks.push(event.data);
            };

            mediaRecorder.onstop = async () => {
                const audioBlob = new Blob(audioChunks, { type: 'audio/wav' });
                const formData = new FormData();
                formData.append('audio', audioBlob, 'audio.wav');

                const response = await fetch('<?= site_url('speech/recognize') ?>', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();
                document.getElementById('transcript').innerText = result.transcript;
            };

            mediaRecorder.start();
        });

        document.getElementById('stop').addEventListener('click', () => {
            mediaRecorder.stop();
        });
    </script>
</body>
</html>
