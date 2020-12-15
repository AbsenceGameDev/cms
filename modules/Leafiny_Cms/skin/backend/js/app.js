$(document).ready(function() {
    let pagesFormPage = $('.page-admin-pages-edit:first');
    let blocksFormPage = $('.page-admin-blocks-edit:first');

    if (pagesFormPage.length) {
        pagesFormPage.leafinyCategorySelector();

        copyValue('title', 'path_key', true);
        copyValue('title', 'meta_title', false);
    }

    if (blocksFormPage.length) {
        blocksFormPage.leafinyCategorySelector();
    }

    let blockSnippet = $('#block-snippet');

    if (blockSnippet.length) {
        let copyLink = $('#block-copy-snippet');
        let buttonText = copyLink.text();

        copyLink.click(function (event) {
            event.preventDefault();
            copyInClipboard(blockSnippet);
            $(this).html(buttonText + ' &check;');
        });
    }
});
