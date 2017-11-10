<div id="modules-and-layouts-sidebar" class="modules-and-layouts-holder mw-normalize-css">
    <h3>Settings</h3>
    <div id="tabsnav">
        <div class="mw-ui-btn-nav mw-ui-btn-nav-tabs">
            <a href="javascript:;" class="mw-ui-btn tabnav active">Layouts</a>

            <a href="javascript:;" class="mw-ui-btn tabnav">Modules</a>
            <a href="javascript:;" class="mw-ui-btn tabnav">Settings</a>
        </div>
        <div class="mw-ui-box">
            <div class="mw-ui-box-content tabitem">
                <module type="admin/modules/list_layouts"/>
            </div>

            <div class="mw-ui-box-content tabitem" style="display: none">
                <module type="admin/modules/list"/>
            </div>

            <div class="mw-ui-box-content tabitem" style="display: none">
                Contact - Lorem Ipsum
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            mw.tabs({
                nav: '#tabsnav  .tabnav',
                tabs: '#tabsnav .tabitem'
            });
        });

        $(window).on('resize load orientationchange', function(){
          var root =  document.querySelector('#modules-and-layouts-sidebar');

          if(root !== null){
            var el = root.querySelectorAll('.mw-ui-box-content');
            for(var i = 0; i<el.length; i++){
              console.log(el[i])
              el[i].style.height = (innerHeight - ($(el[i]).offset().top - $(root).offset().top) - 20)  + 'px'
            }

          }
        })

    </script>
</div>