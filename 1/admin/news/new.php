<p class="t cent botli">新增最新消息資料</p>
<form method="post" action="api.php?do=save&tb=<?=$do;?>&pg=admin&pgdo=<?=$do;?>" enctype="multipart/form-data">
    <table width="100%">
        <tbody>
            <!-- <tr class="">
                <td >標題區圖片：</td>
                <td ><input type="file" name="file" id=""></td>
            </tr> -->
            <tr class="">
                <td >最新消息資料：</td>
                <td ><textarea name="name" id="" cols="30" rows="10"></textarea></td>

            </tr>
            <tr>
                <td><input type="submit" value="新增"><input type="reset" value="重置">
                <td></td>
                </td>
            </tr>
        </tbody>
    </table>

</form>