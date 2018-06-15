# Hauptnavigation

lib.mainnav = HMENU
lib.mainnav{
    special = directory
    special.value = 2


    1 = TMENU
    1{
        expAll = 1
        wrap = <ul class="nav navbar-nav">|</ul>
        NO = 1
        NO.wrapItemAndSub  = <li>|</li>
        NO.stdWrap.htmlSpecialChars = 1


        ACT <.NO
        ACT.wrapItemAndSub  = <li class="active">|</li>


        /* für den Fall, wenn in Menüebene 1 unter Seite  exsitieren,  wird hierdurch Dropdown Menü erstellt
        caret: Pfeile für Dropdown Menü
        allWrap = <!!==:>| :   standard  ==> damit Dropdown Menü angezeigt wird
        exp All = 1   :  das Menü immer das Menü auf der Ebene unterhalb des Menüelements an.
                        Dies entspricht einer Situation, in der ein Benutzer auf einen Menüpunkt geklickt hat und das Menü
                        die nächste Ebene ausklappt. Dadurch kann dies standardmäßig für alle Elemente aktiviert werden.
        */
        IFSUB <.NO
        IFSUB{
            allWrap = <!!==:>|
            wrapItemAndSub = <li class="dropdown">|</li>
            ATagBeforeWrap = 1
            linkWrap =|&nbsp;<b class="caret"></b>
            ATagParams = class = "dropdown-toggle" data-toggle="dropdown"
        }

        ACTIFSUB < .IFSUB
        ACTIFSUB{
            allWrap = <!!==:>|
        }

    }

    2 = TMENU
    2{
        wrap = <ul class="dropdown-menu" role="menu" aria-lablelledby="dLable">|</ul>
        expAll = 1

        NO = 1
        NO{
            allWrap = <li>|</li>
            stdWrap.htmlSpecialChars = 1
        }
        ACT < .NO
        ACT{
            ATagParams = class ="active"
            allWrap = <li class = "active">|</li>
        }
    }

}
