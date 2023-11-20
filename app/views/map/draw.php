<?php build('content') ?>

    <div class="card">
        <div class="card-body">
            <section class="canvas-container">
                <canvas id="canvas"></canvas>
            </section>
            
            <div class="row">
                <!-- <div class="col-md-3" id="toolbar">
                    <div>
                        <label for="#">Stroke</label>
                        <input type="color" id="stroke" name="stroke">
                    </div>

                    <div>
                        <label for="#">Line Width</label>
                        <input type="number" id="lineWidth" name="lineWidth" value="5">
                        <button id="clear">Clear</button>
                    </div>
                </div>

                <div class="col-md-9">
                    
                </div> -->
            </div>
        </div>
    </div>
<?php endbuild() ?>

<?php build('styles') ?>
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

        #canvas{
            border: 1px solid red;
            width: 100%;
            height: 300px;
        }
    </style>
<?php endbuild()?>

<?php build('scripts') ?>
    <script>
        $(document).ready(function(){
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
        });
    </script>
<?php endbuild()?>
<?php loadTo()?>