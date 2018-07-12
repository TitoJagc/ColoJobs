<page backtop="30mm" backbottom="10mm" backleft="15mm" backright="20mm">
    <page_header>
        <table style="width: 95%; ">
            <tr>
                <td style="text-align: left;width: 33%">
                    <img style="height:75px" src="<?php echo URL ?>Views/template/imagenes/europass.jpeg">
                </td>
                <td style="text-align: center;width: 34%;">
                    <span style="font-weight: bold; font-size: 14pt;color:blue;">Curriculum Vitae</span>
                </td>
                <td style="text-align: right;    width: 33%">
                  <span style="font-weight: bold; color:blue;">
                  <?php echo $alumne->get("name"); ?>
                  </span>
                    
                </td>
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table style="width: 100%; ">
            <tr>
                <td style="text-align: left;    width: 35%"> </td>
                <td style="text-align: left;    width: 45%"><span style=" font-size: 8pt; color:blue;">Union Europea | http://europass.cedefop.europa.eu </span></td>
                <td style="text-align: right;    width: 20%"><span style=" font-size: 8pt; color:blue;">Pàgina [[page_cu]]/[[page_nb]]</span></td>
            </tr>
        </table>
    </page_footer>


    <table style="width: 100%; borde">
        <tr>
            <td style="width: 160px; text-align: right;">
                <span style="font-weight: bold; color:blue;font-size:9pt">INFORMACIÓ PERSONAL</span>
            </td>
            <td style="width: 10px; ">
           </td>            
            <td>
                <span style="font-size:13pt"><?php echo $alumne->get("name"); ?></span>
            </td>
        </tr>
        <tr>
            <td style="width: 180px; text-align: right;">
                <?php if ($alumne->get("image") != $default_img ):?>
                    <img style="height:100px" src="<?php echo URL."Views/template/".$alumne->get('image');?>">  
                <?php endif;?>
            </td>
            <td style="width: 10px; ">
           </td>            
            <td>
            <br>
                <img src="<?php echo URL."Views/template/imagenes/place.png";?>">
                <span style="font-size:9pt"><?php echo $alumne->get("addressStreet").", ".$alumne->get("postalCode").", ".$alumne->get("municipality"); ?></span>
               
                <br><br>
                <img src="<?php echo URL."Views/template/imagenes/movil.png";?>">
                <span style="font-size:9pt"><?php echo $alumne->get("telephone"); ?></span>
                <br><br>
                <img src="<?php echo URL."Views/template/imagenes/mail.png";?>">
                <span style="font-size:9pt"><?php echo $alumne->get("email"); ?></span>
                <br><br>
                <img src="<?php echo URL."Views/template/imagenes/cake.png";?>">
                <span style="font-size:9pt"><?php echo $this->mysqlToDate($alumne->get("dateOfBirth")); ?></span>
            </td>
        </tr>
    </table>
<br><br>
    <table style="width: 100%">
        <tr>
            <td style="width: 180px; text-align: right;">
                <span style="font-weight: bold; color:blue;font-size:9pt">EXPERIÈNCIA PROFESSIONAL</span>
            </td>
            <td style="width: 10px; ">
           </td>            
            <td>
               <img style="width:470px" src="<?php echo URL."Views/template/imagenes/separador.png";?>">
            </td>
        </tr>

 <?php 
        $datos = $curriculum -> get('experience');
        foreach ($datos as $experiencia) :?>
        
        <tr>
            <td style="width: 180px; text-align: right;vertical-align: top">
            <br>
                <span style="font-weight: bold; vertical-align:; color:blue;font-size:9pt"><?php  echo $this->mysqlToDate($experiencia['startDate'])." - ".$this->mysqlToDate($experiencia['endDate']);?></span>
            </td>
            <td style="width: 10px; ">
           </td>            
            <td style="width:470px;vertical-align: top">
            <br>
                <span style="font-size:12pt;color:blue;s"><?php echo $experiencia['position']; ?></span>
               
                <br><br>
                <span style="font-size:9pt"><?php echo $experiencia["employer"].", Sector(".$experiencia["sector"].")"; ?></span>

                <br><br>
                <span style="font-size:9pt"><?php echo $experiencia["mainActivities"]; ?></span>
               
            </td>
        </tr>        
       
         <?php endforeach; ?> 
    </table>

<br><br>
    <table style="width: 100%">
        <tr>
            <td style="width: 180px; text-align: right;">
                <span style="font-weight: bold; color:blue;font-size:9pt">CICLES FORMATIUS</span>
            </td>
            <td style="width: 10px; ">
           </td>            
            <td>
               <img style="width:470px" src="<?php echo URL."Views/template/imagenes/separador.png";?>">
            </td>
        </tr>

 <?php 
        $cicles = $curriculum -> get('cicles');
        foreach ($cicles as $cicle) :?>
        
        <tr style="border:solid 1px black">
            <td style="width: 180px; text-align: right; vertical-align: top; ">
            <br>
                <span style="font-weight: bold; color:blue;font-size:9pt"><?php  echo "Promoció: ".$cicle['class'];?></span>
            </td>
            <td style="width: 10px;">
           </td>            
            <td style="width:470px; vertical-align: top;">
            <br>
                <span style="font-size:12pt;color:blue;"><?php echo $cicle['name']; ?></span>
                 
            </td>
        </tr>        
       
         <?php endforeach; ?> 
    </table>

<br><br>
    <table style="width: 100%">
        <tr>
            <td style="width: 180px; text-align: right;">
                <span style="font-weight: bold; color:blue;font-size:9pt">ALTRE FORMACIÓ</span>
            </td>
            <td style="width: 10px; ">
           </td>            
            <td>
               <img style="width:470px" src="<?php echo URL."Views/template/imagenes/separador.png";?>">
            </td>
        </tr>

 <?php 
        $edus = $curriculum -> get('otherEducation');
        foreach ($edus as $edu) :?>
        
        <tr>
            <td style="width: 180px; text-align: right; vertical-align: top">
            <br>
                <span style="font-weight: bold; color:blue;font-size:9pt"><?php  echo $this->mysqlToDate($edu['startDate'])." - ".$this->mysqlToDate($edu['endDate']);?></span>
            </td>
            <td style="width: 10px; ">
           </td>            
            <td style="width:470px">
            <br>
                <span style="font-size:12pt;color:blue;vertical-align: top"><?php echo $edu['title']; ?></span>
               
                <br><br>
                <span style="font-size:9pt"><?php echo $edu["organization"]; ?></span>

                <br><br>
                <span style="font-size:9pt"><?php echo $edu["mainLearnedCapacities"]; ?></span>
               
            </td>
        </tr>        
       
         <?php endforeach; ?> 
    </table>

<br><br>
    <table style="width: 100%">
        <tr>
            <td style="width: 180px; text-align: right;">
                <span style="font-weight: bold; color:blue;font-size:9pt">COMPETÈNCIES PERSONALS</span>
            </td>
            <td style="width: 10px; ">
           </td>            
            <td>
               <img style="width:470px" src="<?php echo URL."Views/template/imagenes/separador.png";?>">
            </td>
        </tr>
        <tr>
            <td style="width: 180px; text-align: right;">
                &nbsp;
            </td>
            <td style="width: 10px; ">
           </td>            
            <td>

            </td>
        </tr>
         <tr>
            <td style="width: 180px; text-align: right;">
                <span style="font-weight: bold; color:blue;font-size:12pt">Idiomes</span>

            </td>
            <td style="width: 10px; ">
           </td>            
            <td style="width: 470px">
                <table style="width: 100%;">
                <tr style="border-bottom: solid 1px gray">
                <th style="width: 110px; text-align: center">LL. Materna</th>
                <th style="width: 110px; text-align: center">Expr. Oral</th>
                <th style="width: 110px; text-align: center">Expr. Escrita</th>
                <th style="width: 140px">Comprenssió Lectora</th>
                </tr>
                </table>
            </td>
        </tr>  
 <?php 
        $langs= $curriculum -> get('languages');
        foreach ($langs as $lang) :?>
        
        <tr>
            <td style="width: 180px; text-align: right;">
                <span style="font-weight: bold; font-size:9pt"><?php  echo $lang['language'];?></span>
            </td>
            <td style="width: 10px; ">
           </td>            
            <td style="width:470px">
              <table style="width: 100%;">
                <tr>
                <td style="width: 110px; text-align: center">
                    <?php  if($lang['isMotherTongue']){
                        echo 'SI';
                    };?>
                </td>
                <td style="width: 110px; text-align: center"><?php  echo $lang['spokenLevel'];?></td>
                <td style="width: 110px; text-align: center"><?php  echo $lang['writtenLevel'];?></td>
                <td style="width: 140px; text-align: center"><?php  echo $lang['readingLevel'];?></td>
                </tr>
              </table>
               
            </td>
        </tr>        
       
         <?php endforeach; ?> 


        <tr>
            <td style="width: 180px; text-align: right;">
                &nbsp;
            </td>
            <td style="width: 10px; ">
           </td>            
            <td>
                &nbsp;
            </td>
        </tr>

        <tr>
            <td style="width: 180px; text-align: right;">
                &nbsp;
            </td>
            <td style="width: 10px; ">
           </td>            
            <td>
                &nbsp;
            </td>
        </tr>
    
       
        <?php 
        $carnets = $curriculum -> get('licences');
        $str_carnets="";
        foreach ($carnets as $carnet) :
            if ($str_carnets) {
                $str_carnets .= ", ".$carnet['licence'];
            }else{
                $str_carnets .= $carnet['licence'];
            } 
        endforeach; 
        if($str_carnets):
        ?> 


        <tr>
            <td style="width: 180px; text-align: right;">
                <span style="font-weight: bold; color:blue;font-size:12pt">Permís de conduir</span>
            </td>
            <td style="width: 10px; ">
           </td>            
            <td style="width:470px">

                <span style="font-size:9pt;"><?php echo $str_carnets; ?></span>
                              
            </td>
        </tr> 

        <?php endif;?>
    </table>
</page>
