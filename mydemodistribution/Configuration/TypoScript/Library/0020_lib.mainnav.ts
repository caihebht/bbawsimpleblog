# Hauptnavigation

lib.mainnav = HMENU
lib.mainnav{
    special = directory
    special.value = 2


    1 = TMENU
    1{
        wrap = <ul class="nav navbar-nav">|</ul>
        NO = 1
        NO.wrapItemAndSub  = <li>|</li>
        NO.stdWrap.htmlSpecialChars = 1


        ACT <.NO
        ACT.wrapItemAndSub  = <li class="active">|</li>


    }

}
