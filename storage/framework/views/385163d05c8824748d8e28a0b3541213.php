<?php $__env->startSection('content'); ?>
<section class="cabecario">
    <h1>Dashboard - Recrutador</h1>

    <div class="cabExtras">

        <div class="btFiltros filtros">
            <figure>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon></svg>
            </figure>
            <span>Filtros</span>
        </div>

        <div class="btFiltros datas">
            <figure>
                <svg width="18px" height="20px" viewBox="0 0 18 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <!-- Generator: Sketch 52.5 (67469) - http://www.bohemiancoding.com/sketch -->
                    <title>date_range</title>
                    <desc>Created with Sketch.</desc>
                    <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Rounded" transform="translate(-307.000000, -244.000000)">
                            <g id="Action" transform="translate(100.000000, 100.000000)">
                                <g id="-Round-/-Action-/-date_range" transform="translate(204.000000, 142.000000)">
                                    <g>
                                        <polygon id="Path" points="0 0 24 0 24 24 0 24"></polygon>
                                        <path d="M19,4 L18,4 L18,3 C18,2.45 17.55,2 17,2 C16.45,2 16,2.45 16,3 L16,4 L8,4 L8,3 C8,2.45 7.55,2 7,2 C6.45,2 6,2.45 6,3 L6,4 L5,4 C3.89,4 3.01,4.9 3.01,6 L3,20 C3,21.1 3.89,22 5,22 L19,22 C20.1,22 21,21.1 21,20 L21,6 C21,4.9 20.1,4 19,4 Z M19,19 C19,19.55 18.55,20 18,20 L6,20 C5.45,20 5,19.55 5,19 L5,9 L19,9 L19,19 Z M7,11 L9,11 L9,13 L7,13 L7,11 Z M11,11 L13,11 L13,13 L11,13 L11,11 Z M15,11 L17,11 L17,13 L15,13 L15,11 Z" id="?Icon-Color" fill="#1D1D1D"></path>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
            </figure>

            <span>Este m&ecirc;s</span>
        </div>

    </div>

</section>

<section class="sessao">
    
    
    <article class="f4 resumo">
        
        <figure>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g>
                    <path fill="none" d="M0 0h24v24H0z"></path>
                    <path d="M3 19V5.7a1 1 0 0 1 .658-.94l9.671-3.516a.5.5 0 0 1 .671.47v4.953l6.316 2.105a1 1 0 0 1 .684.949V19h2v2H1v-2h2zm2 0h7V3.855L5 6.401V19zm14 0v-8.558l-5-1.667V19h5z"></path>
                </g>
            </svg>
            
            <figcaption>
                Empresas <span>ativas</span>
            </figcaption>
        </figure>
        
        <h3><?php echo e($totalEmpresasAtivas); ?></h3>
        
        <small><b><?php echo e($totalEmpresasInativas); ?> empresas</b> inativas</small>
        
    </article>
    
    
    
    <article class="f4 resumo">
        
        <figure>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><title>Document</title><g id="_21-30" data-name="21-30"><g id="Document"><path d="M25.535,6.121,22.879,3.465A4.969,4.969,0,0,0,19.343,2H10A5.006,5.006,0,0,0,5,7V25a5.006,5.006,0,0,0,5,5H22a5.006,5.006,0,0,0,5-5V9.657A4.969,4.969,0,0,0,25.535,6.121ZM24.121,7.535A3.042,3.042,0,0,1,24.5,8H22a1,1,0,0,1-1-1V4.5a3.042,3.042,0,0,1,.465.38ZM22,28H10a3,3,0,0,1-3-3V7a3,3,0,0,1,3-3h9V7a3,3,0,0,0,3,3h3V25A3,3,0,0,1,22,28Z"></path><path d="M11,11h4a1,1,0,0,0,0-2H11a1,1,0,0,0,0,2Z"></path><path d="M21,13H11a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Z"></path><path d="M21,17H11a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Z"></path><path d="M19,21H11a1,1,0,0,0,0,2h8a1,1,0,0,0,0-2Z"></path></g></g></svg>

            
            <figcaption>
                Vagas <span>totais</span>
            </figcaption>
        </figure>
        
        <h3><?php echo e($totalJobs); ?></h3>
        
        <small><b>20 vagas</b> inativas</small>
        
    </article>
    
    <article class="f4 resumo">
        
        <figure>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><title>Document</title><g id="_21-30" data-name="21-30"><g id="Document"><path d="M25.535,6.121,22.879,3.465A4.969,4.969,0,0,0,19.343,2H10A5.006,5.006,0,0,0,5,7V25a5.006,5.006,0,0,0,5,5H22a5.006,5.006,0,0,0,5-5V9.657A4.969,4.969,0,0,0,25.535,6.121ZM24.121,7.535A3.042,3.042,0,0,1,24.5,8H22a1,1,0,0,1-1-1V4.5a3.042,3.042,0,0,1,.465.38ZM22,28H10a3,3,0,0,1-3-3V7a3,3,0,0,1,3-3h9V7a3,3,0,0,0,3,3h3V25A3,3,0,0,1,22,28Z"></path><path d="M11,11h4a1,1,0,0,0,0-2H11a1,1,0,0,0,0,2Z"></path><path d="M21,13H11a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Z"></path><path d="M21,17H11a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Z"></path><path d="M19,21H11a1,1,0,0,0,0,2h8a1,1,0,0,0,0-2Z"></path></g></g></svg>

            
            <figcaption>
                Vagas <span>abertas</span>
            </figcaption>
        </figure>
        
        <h3><?php echo e($openJobs); ?></h3>
        
        <small><b>20 vagas</b> concluidas</small>
        
    </article>
    
    <article class="f4 resumo">
        
        <figure>
            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
            <defs>
                <style>
                    .cls-1 {
                        fill: #000;
                        stroke-width: 0px;
                    }
                </style>
            </defs>
            <path class="cls-1" d="M39.544,10.124l-6.62-6.651c-.931-.936-2.223-1.473-3.544-1.473H12c-2.757,0-5,2.243-5,5v34c0,2.757,2.243,5,5,5h24c2.757,0,5-2.243,5-5V13.651c0-1.331-.517-2.583-1.456-3.527ZM37.594,11h-4.594c-.551,0-1-.449-1-1v-4.62l5.594,5.62ZM39,41c0,1.654-1.346,3-3,3H12c-1.654,0-3-1.346-3-3V7c0-1.654,1.346-3,3-3h17.38c.209,0,.417.025.62.069v5.931c0,1.654,1.346,3,3,3h5.923c.047.212.077.429.077.651v27.349Z"></path>
            <path class="cls-1" d="M34,19h-6c-.552,0-1,.448-1,1s.448,1,1,1h6c.552,0,1-.448,1-1s-.448-1-1-1Z"></path>
            <path class="cls-1" d="M34,25H14c-.552,0-1,.448-1,1s.448,1,1,1h20c.552,0,1-.448,1-1s-.448-1-1-1Z"></path>
            <path class="cls-1" d="M34,31H14c-.552,0-1,.448-1,1s.448,1,1,1h20c.552,0,1-.448,1-1s-.448-1-1-1Z"></path>
            <path class="cls-1" d="M34,37H14c-.552,0-1,.448-1,1s.448,1,1,1h20c.552,0,1-.448,1-1s-.448-1-1-1Z"></path>
            <path class="cls-1" d="M16,22h6c1.654,0,3-1.346,3-3,0-2.282-1.546-4.191-3.639-4.788.989-.729,1.639-1.892,1.639-3.212,0-2.206-1.794-4-4-4s-4,1.794-4,4c0,1.32.65,2.483,1.639,3.212-2.093.597-3.639,2.506-3.639,4.788,0,1.654,1.346,3,3,3ZM19,9c1.103,0,2,.897,2,2s-.897,2-2,2-2-.897-2-2,.897-2,2-2ZM18,16h2c1.654,0,3,1.346,3,3,0,.551-.449,1-1,1h-6c-.551,0-1-.449-1-1,0-1.654,1.346-3,3-3Z"></path>
        </svg>
            
            <figcaption>
                Curr&iacute;culos <span>dispon&iacute;veis</span>
            </figcaption>
        </figure>
        
        <h3><?php echo e($totalResumes); ?></h3>
        
        <small><b>198 curr&iacute;culos</b> inativos</small>
        
    </article>
</section>
   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/flav6095/painelasppe.com.br/resources/views/dashboard/recruiter.blade.php ENDPATH**/ ?>