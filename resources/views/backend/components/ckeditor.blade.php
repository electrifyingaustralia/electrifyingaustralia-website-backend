@php
    $name = $name ?? 'editor1';
    $value = $value ?? '';
    $height = $height ?? 400;
    $toolbar = $toolbar ?? 'full';
    $stylesSet = $stylesSet ?? 'my_custom_styles';
@endphp

<textarea id="{{ $name }}" name="{{ $name }}" class="ckeditor {{ $class ?? '' }}">{{ $value }}</textarea>

@push('styles')
    <style>
        .info-box {
            background: #e3f2fd;
            border: 1px solid #90caf9;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }

        .warning-box {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }

        .success-box {
            background: #d1f2eb;
            border: 1px solid #82e0aa;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }

        /* CKEditor container styling */
        .ckeditor {
            width: 100%;
            min-height: {{ $height }}px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <script>
        CKEDITOR.disableNotifications = true;

        // Override the notification system
        CKEDITOR.on('instanceReady', function(evt) {
            var editor = evt.editor;
            editor._.notifications = [];
            editor.showNotification = function() {};
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Define custom style set
            CKEDITOR.stylesSet.add('my_custom_styles', [
                // Headers
                {
                    name: 'Red Title',
                    element: 'h2',
                    styles: {
                        color: '#dc2626',
                        'font-weight': 'bold'
                    }
                },
                {
                    name: 'Blue Title',
                    element: 'h3',
                    styles: {
                        color: '#2563eb',
                        'font-weight': 'bold'
                    }
                },
                {
                    name: 'Green Title',
                    element: 'h4',
                    styles: {
                        color: '#16a34a',
                        'font-weight': 'bold'
                    }
                },

                // Info Boxes
                {
                    name: 'Info Box',
                    element: 'div',
                    attributes: {
                        'class': 'info-box'
                    }
                },
                {
                    name: 'Warning Box',
                    element: 'div',
                    attributes: {
                        'class': 'warning-box'
                    }
                },
                {
                    name: 'Success Box',
                    element: 'div',
                    attributes: {
                        'class': 'success-box'
                    }
                },

                // Text Styles
                {
                    name: 'Lead Text',
                    element: 'p',
                    styles: {
                        'font-size': '1.125rem',
                        'font-weight': '300',
                        'line-height': '1.6'
                    }
                },
                {
                    name: 'Small Text',
                    element: 'p',
                    styles: {
                        'font-size': '0.875rem',
                        'color': '#6b7280'
                    }
                },

                // Buttons
                {
                    name: 'Primary Button',
                    element: 'span',
                    styles: {
                        color: 'white',
                        'background-color': '#0d9488',
                        padding: '8px 16px',
                        'border-radius': '6px',
                        'font-weight': '500',
                        'display': 'inline-block',
                        'margin': '2px'
                    }
                },
                {
                    name: 'Secondary Button',
                    element: 'span',
                    styles: {
                        color: '#374151',
                        'background-color': '#f3f4f6',
                        padding: '8px 16px',
                        'border-radius': '6px',
                        'font-weight': '500',
                        'display': 'inline-block',
                        'margin': '2px'
                    }
                }
            ]);

            // Toolbar configurations
            const toolbarConfigs = {
                full: [{
                        name: 'document',
                        items: ['Source', '-', 'Preview', 'Print', '-', 'Templates']
                    },
                    {
                        name: 'clipboard',
                        items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
                    },
                    {
                        name: 'editing',
                        items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                    },
                    {
                        name: 'forms',
                        items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button',
                            'ImageButton', 'HiddenField'
                        ]
                    },
                    '/',
                    {
                        name: 'basicstyles',
                        items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-',
                            'RemoveFormat'
                        ]
                    },
                    {
                        name: 'paragraph',
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote',
                            'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight',
                            'JustifyBlock'
                        ]
                    },
                    {
                        name: 'links',
                        items: ['Link', 'Unlink', 'Anchor']
                    },
                    {
                        name: 'insert',
                        items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak',
                            'Iframe'
                        ]
                    },
                    '/',
                    {
                        name: 'styles',
                        items: ['Styles', 'Format', 'Font', 'FontSize']
                    },
                    {
                        name: 'colors',
                        items: ['TextColor', 'BGColor']
                    },
                    {
                        name: 'tools',
                        items: ['Maximize', 'ShowBlocks']
                    }
                ],
                basic: [{
                        name: 'basicstyles',
                        items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat']
                    },
                    {
                        name: 'paragraph',
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                            'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'
                        ]
                    },
                    {
                        name: 'links',
                        items: ['Link', 'Unlink']
                    },
                    {
                        name: 'insert',
                        items: ['Image', 'Table', 'HorizontalRule']
                    },
                    {
                        name: 'tools',
                        items: ['Maximize']
                    }
                ],
                minimal: [{
                        name: 'basicstyles',
                        items: ['Bold', 'Italic', 'Underline']
                    },
                    {
                        name: 'paragraph',
                        items: ['NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter',
                            'JustifyRight'
                        ]
                    },
                    {
                        name: 'links',
                        items: ['Link', 'Unlink']
                    }
                ]
            };

            // Initialize CKEditor
            const editorName = '{{ $name }}';
            const toolbarType = '{{ $toolbar }}';
            const editorHeight = {{ $height }};
            const stylesSetName = '{{ $stylesSet }}';

            CKEDITOR.replace(editorName, {
                height: editorHeight,
                extraPlugins: 'colorbutton,font,justify,print,liststyle,pagebreak,smiley,iframe,forms,div',
                removePlugins: 'easyimage,cloudservices',
                contentsCss: [
                    'https://cdn.ckeditor.com/4.22.1/full-all/contents.css'
                ],
                stylesSet: stylesSetName,
                toolbar: toolbarConfigs[toolbarType] || toolbarConfigs.full,
                format_tags: 'p;h1;h2;h3;h4;h5;h6;pre;div',
                font_names: 'Arial/Arial, Helvetica, sans-serif;' +
                    'Comic Sans MS/Comic Sans MS, cursive;' +
                    'Courier New/Courier New, Courier, monospace;' +
                    'Georgia/Georgia, serif;' +
                    'Lucida Sans Unicode/Lucida Sans Unicode, Lucida Grande, sans-serif;' +
                    'Tahoma/Tahoma, Geneva, sans-serif;' +
                    'Times New Roman/Times New Roman, Times, serif;' +
                    'Trebuchet MS/Trebuchet MS, Helvetica, sans-serif;' +
                    'Verdana/Verdana, Geneva, sans-serif',
                // Use your existing media store route for file uploads
                filebrowserUploadUrl: '{{ route('admin.media.store') }}',
                filebrowserUploadMethod: 'form'
            });

            // Custom file upload handler to match your media library response format
            CKEDITOR.on('instanceReady', function(ev) {
                ev.editor.on('fileUploadRequest', function(evt) {
                    var fileLoader = evt.data.fileLoader;
                    var formData = new FormData();

                    // Add CSRF token
                    formData.append('_token', '{{ csrf_token() }}');
                    // Add file with the correct field name that your MediaLibraryController expects
                    formData.append('files[]', fileLoader.file);
                    // Add empty alt_name to match your controller expectations
                    formData.append('alt_name[]', '');

                    // Update the request data
                    evt.data.fileLoader.xhr.send(formData);
                    evt.stop();
                });

                // Handle the response to match CKEditor's expected format
                ev.editor.on('fileUploadResponse', function(evt) {
                    var fileLoader = evt.data.fileLoader;
                    var response = JSON.parse(fileLoader.xhr.responseText);

                    if (response.success && response.items && response.items.length > 0) {
                        // Transform your media library response to CKEditor's expected format
                        evt.data.url = response.items[0].url;
                        evt.data.fileName = response.items[0].file_name;
                    } else {
                        evt.data.message = 'Upload failed';
                        evt.data.error = response.message || 'Unknown error';
                    }

                    // Prevent the default response handler
                    evt.stop();
                });
            });
        });
    </script>
@endpush
