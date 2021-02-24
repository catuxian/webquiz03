<h3 class="ct">新增院線片</h3>
<form action="api/add_movie.php" method="post" enctype="multipart/form-data">
    <table width="80%" style="margin: auto;text-align:center">
        <tr>
            <td width="20%">影片資料</td>
            <td>
                <div>片名: <input type="text" name="name" id=""></div>
                <div>分級:
                    <select name="level" id="">
                        <option value="普遍級">普遍級</option>
                        <option value="輔導級">輔導級</option>
                        <option value="保護級">保護級</option>
                        <option value="限制級">限制級</option>
                    </select>
                </div>
                <div>片長: <input type="text" name="length" id=""></div>
                <div>
                    上映日期:
                    <input type="date" name="ondate" id="">
                </div>
                <div>發行商:<input type="text" name="publish"></div>
                <div>導演: <input type="text" name="director"></div>
                <div>預告影片: <input type="file" name="trailer" id=""></div>
                <div>電影海報: <input type="file" name="poster" id=""></div>
            </td>
        </tr>
        <tr>
            <td>劇情簡介</td>
            <td>
                    <textarea name="intro" style="width: 80%;"></textarea>
                </td>
        </tr>
    </table>
    <div class="ct">
        <input type="submit" value="新增">
        <input type="reset" value="重置">
    </div>
</form>