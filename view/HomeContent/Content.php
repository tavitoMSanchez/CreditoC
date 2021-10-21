<?php
    require_once("../../config/conexion.php");

    require_once("../../models/Menu.php");
    $dato = new Menu();
    $datx = $dato ->get_datos2();
?>
 <div class="col-xl-6">
 <?php
           foreach ($datx as $datxx){
        ?>
	                <div class="row">
	                    <div class="col-sm-6"> 
	                        <article class="statistic-box red">
	                            <div>
	                                <div class="number"><?php echo $datxx[0]?></div>
	                                <div class="caption"><div>CANCELADOS</div></div>
	                                <div class="percent">
	                                    <div class="arrow down"></div>
	                                    <!-- <p>15%</p> -->
	                                </div>
	                            </div>
	                        </article>
	                    </div><!--.col-->
	                    <div class="col-sm-6">
	                        <article class="statistic-box purple">
	                            <div>
	                                <div class="number"><?php echo $datxx[1]?></div>
	                                <div class="caption"><div>TOTAL</div></div>
	                                <div class="percent">
	                                    <div class="arrow up"></div>
	                                    <!-- <p>11%</p> -->
	                                </div>
	                            </div>
	                        </article>
	                    </div><!--.col-->
	                    <div class="col-sm-6">
	                        <article class="statistic-box yellow">
	                            <div>
	                                <div class="number"><?php echo $datxx[2]?></div>
	                                <div class="caption"><div>ESPERA</div></div>
	                                <div class="percent">
	                                    <div class="arrow down"></div>
	                                    <!-- <p>5%</p> -->
	                                </div>
	                            </div>
	                        </article>
	                    </div><!--.col-->
	                    <div class="col-sm-6">
	                        <article class="statistic-box green">
	                            <div>
	                                <div class="number"><?php echo $datxx[3]?></div>
	                                <div class="caption"><div>REALIZADO</div></div>
	                                <div class="percent">
	                                    <div class="arrow up"></div>
	                                    <!-- <p>84%</p> -->
	                                </div>
	                            </div>
	                        </article>
	                    </div><!--.col-->
                       
	                </div><!--.row-->
                    <?php
            }
        ?>
	            </div>