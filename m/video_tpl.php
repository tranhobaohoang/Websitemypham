
<div class="tcat"><div class="icon"><?= $title_tcat ?></div></div>
<div class="box_content">
    <div class="content">

        <div class="row">     	         
            <?php
            if (count($tintuc) > 0) {
                for ($i = 0, $count_tintuc = count($tintuc); $i < $count_tintuc; $i++) {
                    ?>
                    <div class="col-md-4 col-sm-4 col-xs-4 video">     
                        <div class="item_product_menu">
                            <div class="images">
								<a class="xem_video" href="<?= getYoutubeIdFromUrl($tintuc[$i]['link']) ?>">
                                    <img class="img-responsive" style="border:solid 1px #ccc" src="http://img.youtube.com/vi/<?= getYoutubeIdFromUrl($tintuc[$i]['link']) ?>/0.jpg" alt="<?= $tintuc[$i]['ten'] ?>">
                                </a>      
                            </div>
							<div class="name"><?= $tintuc[$i]['ten'] ?></div>
                        </div>
                    </div>

                    <?php
                }
            } else
                echo '<p>Nội dung đang cập nhật, bạn vui lòng xem các chuyên mục khác.</p>';
            ?>            
        </div>                         
        <div class="phantrang" ><?= $paging['paging'] ?></div>
    </div>
</div>

