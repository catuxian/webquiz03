<?php
    $movie=$Movie->find($_GET['id']);
?>
<h3 class="ct">編輯電影</h3>
<form action="api/edit_movie.php" method="post" enctype="multipart/form-data">
    <table width="80%" style="margin: auto;text-align:center">
        <tr>
            <td width="20%">影片資料</td>
            <td>
                <div>片名: <input type="text" name="name" id="" value="<?=$movie['name'];?>"></div>
                <div>分級:
                    <select name="level" id="">
                        <option value="普遍級" <?=($movie['level']=="普遍級")?"selected":"";?>>普遍級</option>
                        <option value="輔導級" <?=($movie['level']=="輔導級")?"selected":"";?>>輔導級</option>
                        <option value="保護級" <?=($movie['level']=="保護級")?"selected":"";?>>保護級</option>
                        <option value="限制級" <?=($movie['level']=="限制級")?"selected":"";?>>限制級</option>
                    </select>
                </div>
                <div>片長: <input type="text" name="length" id="" value="<?=$movie['length'];?>"></div>
                <div>
                    上映日期:
                    <input type="date" name="ondate" id="" value="<?=$movie['ondate'];?>">
                </div>
                <div>發行商:<input type="text" name="publish" value="<?=$movie['publish'];?>"></div>
                <div>導演: <input type="text" name="director" value="<?=$movie['director'];?>"></div>
                <div>預告影片: <input type="file" name="trailer" value="img/<?=$movie['trailer'];?>"></div>
                <div>電影海報: <input type="file" name="poster" id="" value="img/<?=$movie['poster'];?>"></div>
            </td>
        </tr>
        <tr>
            <td>劇情簡介</td>
            <td>
                    <textarea name="intro" style="width: 80%;"><?=$movie['intro'];?></textarea>
                </td>
        </tr>
    </table>
    <div class="ct">
        <input type="hidden" name="id" value="<?=$movie['id'];?>">
        <input type="submit" value="編輯">
        <input type="reset" value="重置">
    </div>
</form>