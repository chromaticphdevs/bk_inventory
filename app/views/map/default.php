<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            color: white;
        }

        h1{
            background:  #7f7fD5;
        }   
        .canvas-container img{
            z-index: -1000;
        }
        canvas#canvas{
            z-index: 1000;
            position: absolute;
            top: 0;
            left: 0;
        }
    </style>
</head>
<body>
    <section class="canvas-container">
        <img src="<?php echo _path_upload_get('map_samp.JPG')?>" alt="test"
            style="width:900px; height:900px; margin:0px auto">
        <canvas id="canvas"></canvas>
    </section>

    <script>
        let isPainting = false;
        let lineWidth = 5;
        let startX;
        let startY;

        const canvas = document.getElementById('canvas');
        // const toolbar = document.getElementById('toolbar');
        const ctx = canvas.getContext('2d');

        const canvasOffsetX = canvas.offsetLeft;
        const canvasOffsetY = canvas.offsetTop;

        canvas.width = window.innerWidth - canvasOffsetX;
        canvas.height = window.innerHeight - canvasOffsetY;

        const draw = (e) => {
            console.log('mousemoving');
            if(!isPainting) {
                return;
            }

            ctx.lineWidth = lineWidth;
            ctx.lineCap = 'round';
            ctx.strokeStyle = 'red';
            ctx.lineTo(e.clientX - canvasOffsetX, e.clientY);
            ctx.stroke(); 
        }
        

        // toolbar.addEventListener('change', e => {
        //     if(e.target.id === 'stroke') {
        //         ctx.strokeStyle = e.target.value;
        //         console.log(e.target.value);
        //     }

        //     if(e.target.id === 'lineWidth') {
        //         lineWidth = e.target.value;
        //     }
        // })

        // toolbar.addEventListener('click', e => {
        //     if(e.target.id === 'clear') {
        //         ctx.clearRect(0, 0, canvas.width, canvas.height)
        //     }
        // })

        canvas.addEventListener('mousedown', (e) => {
            console.log('mousedown');
            isPainting = true;
            startX = e.clientX;
            startY = e.clientY;
        });

        canvas.addEventListener('mouseup', e => {
            console.log('mouse up');
            isPainting = false,
            ctx.stroke();
            ctx.beginPath();
        });

        canvas.addEventListener('mousemove', draw);
    </script>
</body>
</html>