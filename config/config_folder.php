<?php
if(!file_exists("../sfdatas/grups/")){
    mkdir("../sfdatas/grups/", 0777, true);
}
if(!file_exists("../sfdatas/grups/$grup_code_ac/")){
    mkdir("../sfdatas/grups/$grup_code_ac/", 0777, true);
}
/* kas rt s */
if(!file_exists("../sfdatas/grups/$grup_code_ac/kasrt/")){
    mkdir("../sfdatas/grups/$grup_code_ac/kasrt/", 0777, true);
}
if(!file_exists("../sfdatas/grups/$grup_code_ac/kasrt/catatan/")){
    mkdir("../sfdatas/grups/$grup_code_ac/kasrt/catatan/", 0777, true);
}
if(!file_exists("../sfdatas/grups/$grup_code_ac/kasrt/catatan_temp/")){
    mkdir("../sfdatas/grups/$grup_code_ac/kasrt/catatan_temp/", 0777, true);
}
/* kas rt e */

/* old file s */
if(!file_exists("../sfdatas/grups/$grup_code_ac/oldfiles/")){
    mkdir("../sfdatas/grups/$grup_code_ac/oldfiles", 0777, true);
}
    /* kas rt */
        if(!file_exists("../sfdatas/grups/$grup_code_ac/oldfiles/kasrt/")){
            mkdir("../sfdatas/grups/$grup_code_ac/oldfiles/kasrt/", 0777, true);
        }
    /* kas rt */
/* old file e */
?>