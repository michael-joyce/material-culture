function getTinyMceConfig(editorUploadPath) {

    return {
        branding: false,
        selector: '.tinymce',
        plugins: 'hr image imagetools link lists paste wordcount',
        relative_urls: false,
        convert_urls: false,
        height: 240,
        menubar: 'edit insert view format tools',

        toolbar: "undo redo | styleselect | paste | bold italic | alignleft "
            + "aligncenter alignright alignjustify | "
            + "bullist numlist outdent indent | link",

        image_caption: true,
        images_upload_url: editorUploadPath,
        images_upload_credentials: true,
        image_advtab: true,
        image_title: true,

        style_formats_merge: true,
    };

}
