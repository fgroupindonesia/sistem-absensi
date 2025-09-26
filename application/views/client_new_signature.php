<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Digital Signature Pad - Responsive</title>
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    canvas {
      border: 2px solid #333;
      border-radius: 10px;
      width: 100%;
      height: auto;
      touch-action: none;
    }
  </style>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body class="bg-light">

  <div class="container py-4">
    <h3 class="text-center mb-4">Tanda Tangan Digital</h3>

    <div class="card shadow-sm">
      <div class="card-body">
      	<div class="mb-3">
      		<select id="staff-chosen">
      			<?php if(isset($data_staff)): ?>
      				<?php foreach($data_staff as $user): ?>
      			<option value="<?= $user->id; ?>"><?= $user->name; ?> $</option>
      				<?php endforeach; ?>
      		    <?php endif; ?>
      		</select>
      	</div>

        <div class="mb-3">
          <canvas id="signaturePad" width="400" height="200"></canvas>
        </div>

        <div class="d-flex justify-content-between">
        	<button id="btn-fullscreen" onclick="goFullscreenAndLock()">Masuk Layar Penuh</button>
          <button id="clearBtn" class="btn btn-outline-danger">Hapus</button>
          <button id="saveBtn" class="btn btn-success">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      const canvas = document.getElementById('signaturePad');
      const ctx = canvas.getContext('2d');
      let drawing = false;

      function getPosition(e) {
        const rect = canvas.getBoundingClientRect();
        const x = (e.touches ? e.touches[0].clientX : e.clientX) - rect.left;
        const y = (e.touches ? e.touches[0].clientY : e.clientY) - rect.top;
        return { x, y };
      }

      function startDrawing(e) {
        drawing = true;
        const pos = getPosition(e);
        ctx.beginPath();
        ctx.moveTo(pos.x, pos.y);
        e.preventDefault();
      }

      function draw(e) {
        if (!drawing) return;
        const pos = getPosition(e);
        ctx.lineTo(pos.x, pos.y);
        ctx.strokeStyle = "#000";
        ctx.lineWidth = 2;
        ctx.lineCap = "round";
        ctx.stroke();
        e.preventDefault();
      }

      function stopDrawing(e) {
        drawing = false;
        e.preventDefault();
      }

      // Mouse
      $(canvas).mousedown(startDrawing);
      $(canvas).mousemove(draw);
      $(canvas).mouseup(stopDrawing);
      $(canvas).mouseleave(stopDrawing);

      // Touch
      $(canvas).on('touchstart', startDrawing);
      $(canvas).on('touchmove', draw);
      $(canvas).on('touchend', stopDrawing);

      // Hapus
      $('#clearBtn').click(() => ctx.clearRect(0, 0, canvas.width, canvas.height));

      // Simpan
      $('#saveBtn').click(() => {
        const dataURL = canvas.toDataURL("image/png");
        const win = window.open();
        win.document.write('<img src="' + dataURL + '" alt="Signature"/>');
      });

      // Resize (responsiveness workaround)
      function resizeCanvas() {
        const containerWidth = canvas.parentElement.offsetWidth;
        const scale = containerWidth / 400; // base width
        canvas.style.width = containerWidth + "px";
        canvas.style.height = (200 * scale) + "px";
      }

      resizeCanvas();
      $(window).resize(resizeCanvas);
    });
  </script>

<script>
  function goFullscreenAndLock() {
  const elem = document.documentElement;

  if (elem.requestFullscreen) {
    elem.requestFullscreen().then(() => {
      if (screen.orientation && screen.orientation.lock) {
        screen.orientation.lock('landscape').catch(err => {
          console.warn('Gagal kunci orientasi:', err);
        });

        $('#btn-fullscreen').hide();

      }
    });
  }
}

</script>
</body>
</html>
