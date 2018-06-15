lib.breadcrumb = HMENU
lib.breadcrumb {
    special = rootline
    special.range = 0|-1

    1 = TMENU
    1 {
        wrap =   <ol class="breadcrumb"> | </ol>
        NO.linkWrap =  <li>| </li>
        CUR = 1
        CUR.linkWrap =  <li class="active">|</li>
        CUR.doNotLinkIt = 1
    }
}


/*
special = rootline   =>HMENU auf Rootline Menü andeuten
Die Range gibt an das von der aktuellen Seite (0) bis zum Root Template (-1) alles mit einbezogen werden soll
Die aktuelle Seite - CURrent - wird nicht verlinkt.

*/
