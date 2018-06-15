## Link zur Homepage
/*
lib.homelink = TEXT
lib.homelink {
    # Homepage Id eingeben
    value = BBAW
    typolink.parameter = 2
    typolink.title = zur Homepage
    typolink.ATagParams = class ="brand"
}
*/
lib.homelink = IMAGE
lib.homelink{
    file = {$resDir}/Public/Images/bbaw-logo.png
    imageLinkWrap = 1
    imageLinkWrap {
        enable = 1
        typolink {
            parameter = 2
            title = Zur Homepage
            AtagParams = class = "rounded float-left"
            ATagParams.insertData = 1
        }
    }
}