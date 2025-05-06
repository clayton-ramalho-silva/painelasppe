<!doctype html>
<html lang="pt-br">
  <head>
    <?php if ($__env->exists('layouts.global.head')) echo $__env->make('layouts.global.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.partials.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldPushContent('css-custom'); ?>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  </head>
  <body>

  <header>
      <!--    AQUI ENTRA O  HEADER LATERAL    -->
      <?php echo $__env->make('layouts.template.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php echo $__env->make('layouts.template.headerResponsive', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!--    AQUI ENTRA O  HEADER LATERAL    -->
  </header>


    <?php if(session('success')): ?>
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <svg width="30px" height="30px" style="margin-bottom: 10px" viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <title>success</title>
            <g id="Page-1" stroke="none" stroke-width="1" fill="#ffffff" fill-rule="evenodd">
                <g id="add-copy" fill="#ffffff" transform="translate(42.666667, 42.666667)">
                    <path d="M213.333333,3.55271368e-14 C95.51296,3.55271368e-14 3.55271368e-14,95.51296 3.55271368e-14,213.333333 C3.55271368e-14,331.153707 95.51296,426.666667 213.333333,426.666667 C331.153707,426.666667 426.666667,331.153707 426.666667,213.333333 C426.666667,95.51296 331.153707,3.55271368e-14 213.333333,3.55271368e-14 Z M213.333333,384 C119.227947,384 42.6666667,307.43872 42.6666667,213.333333 C42.6666667,119.227947 119.227947,42.6666667 213.333333,42.6666667 C307.43872,42.6666667 384,119.227947 384,213.333333 C384,307.43872 307.438933,384 213.333333,384 Z M293.669333,137.114453 L323.835947,167.281067 L192,299.66912 L112.916693,220.585813 L143.083307,190.4192 L192,239.335893 L293.669333,137.114453 Z" id="Shape">

        </path>
                </g>
            </g>
        </svg>
      <div>
        <?php echo e(session('success')); ?>

      </div>
    </div>
    <?php endif; ?>

    <?php if(session('danger')): ?>
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg width="30px" height="30px" style="margin-bottom: 10px" viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <title>danger</title>
                <g id="Page-1" stroke="none" stroke-width="1" fill="#ffffff" fill-rule="evenodd">
                    <g id="error-copy" fill="#ffffff" transform="translate(42.666667, 42.666667)">
                        <path d="M213.333333,3.55271368e-14 C95.51296,3.55271368e-14 3.55271368e-14,95.51296 3.55271368e-14,213.333333 C3.55271368e-14,331.153707 95.51296,426.666667 213.333333,426.666667 C331.153707,426.666667 426.666667,331.153707 426.666667,213.333333 C426.666667,95.51296 331.153707,3.55271368e-14 213.333333,3.55271368e-14 Z M213.333333,384 C119.227947,384 42.6666667,307.43872 42.6666667,213.333333 C42.6666667,119.227947 119.227947,42.6666667 213.333333,42.6666667 C307.43872,42.6666667 384,119.227947 384,213.333333 C384,307.43872 307.438933,384 213.333333,384 Z M240.64,213.333333 L293.973333,160 L272,138.026667 L218.666667,191.36 L165.333333,138.026667 L143.36,160 L196.693333,213.333333 L143.36,266.666667 L165.333333,288.64 L218.666667,235.306667 L272,288.64 L293.973333,266.666667 L240.64,213.333333 Z" id="Shape">
                        </path>
                    </g>
                </g>
            </svg>
          <div>
            <?php echo e(session('danger')); ?>

          </div>
        </div>
    <?php endif; ?>
    <main>
      <!-- TOPO BLOCO MAIN INICIO -->
      <?php echo $__env->make('layouts.template.topo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- TOPO BLOCO MAIN FIM -->

      <!--    AQUI ENTRA A PAGINA    -->
      <?php echo $__env->yieldContent('content'); ?>
      <!--    AQUI ENTRA A PAGINA    -->
    </main>

    <?php echo $__env->make('layouts.partials.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldPushContent('scripts-custom'); ?>
  </body>
</html><?php /**PATH /home1/flav6095/painelasppe.com.br/resources/views/layouts/app.blade.php ENDPATH**/ ?>