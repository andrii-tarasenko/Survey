<div class="col-md-<?php if ($_SERVER['REQUEST_URI'] == '/') {echo '9 mx-auto';} else {echo '7';}?>">
<!--<div class="col-md-7">-->
    <h1>Опитування</h1>
    <?php $i = 0;?>
    <?php foreach ($surveys as $key => $survey) {?>
        <?php $i++;?>
        <div class="card">
            <div class="card-header" id="heading<?php echo $i;?>">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse"
                            data-target="#collapse<?php echo $i;?>" aria-expanded="true"
                            aria-controls="collapse<?php echo $i;?>">
                        <?php echo $key;?>
                    </button>
                </h2>
            </div>
            <div id="collapse<?php echo $i;?>" class="panel-collapse collapse">
                <ul class="list-group">
                    <?php foreach ($survey['questions'] as $k => $value) {?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo $value['questions'];?>
                            <span class="badge badge-primary badge-pill">
                                        <?php echo $value['countOfVoices'];?>
                                    </span>
                        </li>
                    <?php }?>
                </ul>
            </div>
        </div>
    <?php }?>
</div>
