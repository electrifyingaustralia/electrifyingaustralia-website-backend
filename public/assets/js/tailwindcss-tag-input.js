function initializeTagInput($input) {
            const $container = $('<div class="tag-container border border-gray-300 rounded-lg p-2 flex flex-wrap items-center gap-2 cursor-text bg-white"></div>');
            const $hiddenInput = $('<input type="hidden">');
            const $textInput = $('<input type="text" class="tag-input-field flex-1 min-w-0 border-none bg-transparent text-sm">');
            
            // Copy attributes from original input
            $hiddenInput.attr('name', $input.attr('name') || '');
            $textInput.attr('placeholder', $input.attr('placeholder') || 'Add tags...');
            
            // Replace original input
            $input.after($container);
            $input.after($hiddenInput);
            $input.remove();
            
            $container.append($textInput);
            
            let tags = [];
            
            // Initialize with existing value
            const initialValue = $input.val() || '';
            if (initialValue.trim()) {
                const initialTags = initialValue.split(',').map(tag => tag.trim()).filter(tag => tag);
                initialTags.forEach(tag => addTag(tag));
            }
            
            // Focus on container click
            $container.on('click', function() {
                $textInput.focus();
            });
            
            // Handle input events
            $textInput.on('keydown', function(e) {
                const value = $(this).val().trim();
                
                if (e.key === 'Enter' || e.key === ',') {
                    e.preventDefault();
                    if (value) {
                        addTag(value);
                        $(this).val('');
                    }
                    // Prevent form submission on Enter
                    return false;
                } else if (e.key === 'Backspace' && !value && tags.length > 0) {
                    removeTag(tags.length - 1);
                }
            });
            
            $textInput.on('blur', function() {
                const value = $(this).val().trim();
                if (value) {
                    addTag(value);
                    $(this).val('');
                }
            });
            
            function addTag(tagText) {
                // Clean and validate tag
                tagText = tagText.replace(/,/g, '').trim();
                if (!tagText || tags.includes(tagText)) return;
                
                tags.push(tagText);
                
                // Create tag element
                const $tag = $(`
                    <span class="tag-item inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800 border border-blue-200">
                        <span class="mr-1">${escapeHtml(tagText)}</span>
                        <button type="button" class="ml-1 text-blue-600 hover:text-blue-800 focus:outline-none">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </span>
                `);
                
                // Add remove functionality
                $tag.find('button').on('click', function(e) {
                    e.stopPropagation();
                    const index = $container.find('.tag-item').index($tag);
                    removeTag(index);
                });
                
                // Insert before text input
                $textInput.before($tag);
                updateHiddenInput();
            }
            
            function removeTag(index) {
                if (index >= 0 && index < tags.length) {
                    tags.splice(index, 1);
                    $container.find('.tag-item').eq(index).fadeOut(150, function() {
                        $(this).remove();
                        updateHiddenInput();
                    });
                }
            }
            
            function updateHiddenInput() {
                $hiddenInput.val(tags.join(', '));
                $hiddenInput.trigger('change');
            }
            
            function escapeHtml(text) {
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }
            
            // Store reference for external access
            $container.data('getValues', () => tags);
            $container.data('setValues', (newTags) => {
                // Clear existing tags
                tags = [];
                $container.find('.tag-item').remove();
                // Add new tags
                newTags.forEach(tag => addTag(tag));
            });
        }
        
        // Demo function to show all values
        function showValues() {
            const $output = $('#output');
            const $content = $('#output-content');
            $content.empty();
            
            $('.tag-container').each(function(index) {
                const tags = $(this).data('getValues')();
                const label = $(this).closest('div').find('label').text() || `Input ${index + 1}`;
                
                $content.append(`
                    <div class="mb-3">
                        <strong class="text-gray-700">${label}:</strong><br>
                        <span class="text-gray-600 bg-white px-3 py-1 rounded border">${tags.join(', ') || 'No tags'}</span>
                    </div>
                `);
            });
            
            $output.removeClass('hidden');
        }