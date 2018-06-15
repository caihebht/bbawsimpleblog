lib.infoNavi = HMENU
lib.infoNavi {
    special = directory
    special.value = 24

    1 = TMENU
    1 {

        wrap =   <ul> | </ul>
        NO = 1
        NO.wrapItemAndSub = <li> | </li>
        NO.stdWrap.htmlSpecialChars = 1

        ACT < NO
        ACT.wrapItemAndSub = <li class="active"> | </li>

    }
}