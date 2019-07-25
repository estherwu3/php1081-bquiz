<?php
    $it = find1("item",$_GET["id"]);
?>
<h1 class="ct">修改商品</h1>
<form action="api.php?do=edit&tb=item&gt=th" method="POST" enctype="multipart/form-data">
    <table class="all">
        <tr>
            <td class="tt">所屬大類</td>
            <td class="pp">
                <select name="pid" id="pid">
                    <?php
                        $mt=find("type",["pid"=>0]);
                        foreach($mt as $m){
                            echo "<option value='".$m["id"]."'".(($it["pid"]==$m["id"])?"selected":"").">".$m["name"]."</option>";
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="tt">所屬中類</td>
            <td class="pp">
                <select name="sid" id="sid">
                <?php
                        $st=find("type",["pid"=>$it["pid"]]);
                        foreach($st as $s){
                            echo "<option value='".$s["id"]."'".(($it["sid"]==$s["id"])?"selected":"").">".$s["name"]."</option>";
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="tt">商品編號</td>
            <td class="pp"><input type="text" name="no"  id="no" value="<?=$it["no"];?>" readonly></td>
        </tr>
        <tr>
            <td class="tt">商品名稱</td>
            <td class="pp"><input type="text" name="name" id="name" value="<?=$it["name"];?>"></td>
        </tr>
        <tr>
            <td class="tt">商品價格</td>
            <td class="pp"><input type="text" name="price" id="price" value="<?=$it["price"];?>"></td>
        </tr>
        <tr>
            <td class="tt">規格</td>
            <td class="pp"><input type="text" name="spec" id="spec" value="<?=$it["spec"];?>"></td>
        </tr>
        <tr>
            <td class="tt">庫存量</td>
            <td class="pp"><input type="text" name="qt" id="qt" value="<?=$it["qt"];?>"></td>
        </tr>
        <tr>
            <td class="tt">商品圖片</td>
            <td class="pp"><input type="file" name="file" id="file"></td>
        </tr>
        <tr>
            <td class="tt">商品介紹</td>
            <td class="pp"><textarea name="intro" id="intro" cols="30" rows="10" style="width:100%"><?=$it["intro"];?></textarea></td>
        </tr>
    </table>
    <div class="ct">
        <input type="hidden" name="id" value="<?=$it["id"];?>">
        <input type="submit" value="修改">
        <input type="reset" value="重置">
        <input type="button" value="返回" onclick="lof('?do=th')">
    </div>
</form>

<script>
    // updateSS();

    $("#pid").on("change",function(){
        updateSS();       
    });

    // $("#sid").on("change",function(){
    //     updateNo();       
    // });

    function updateSS(){
        let pid =$("#pid").val();
        $.post("api.php?do=find&tb=type",{pid},function(r){
            let ss = $("#sid").empty();
            let st = JSON.parse(r);
            st.forEach(element => {
                ss.append(`<option value='${element.id}'>${element.name}</option>`);
            });
            // updateNo();
        });
    }

    function updateNo(){
        let pid =$("#pid").val();
        let sid =$("#sid").val();
        $("#no").val("0".repeat(2-pid.length)+pid+"0".repeat(2-sid.length)+sid+(Math.floor(Math.random()*89)+10));
    }
</script>