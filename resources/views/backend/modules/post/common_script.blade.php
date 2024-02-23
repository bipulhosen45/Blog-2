<script>
    const get_sub_categories = (category_id) => {
        let route_name = '{{Route::currentRouteName()}}'

        let sub_category_element = $('#sub_category_id')
        sub_category_element.empty()
        let sub_category_select = ''
        if (route_name != 'post.edit') {
            sub_category_select = 'selected'
        }
        sub_category_element.append(`<option ${sub_category_select}>Select Sub Category</option>`);
        axios.get(window.location.origin + '/admin/get-subcategory/' + category_id).then(res => {
            let sub_categories = res.data

            sub_categories.map((sub_category, index) => {
                let selected = ''
                if (route_name == 'post.edit') {
                    let sub_category_id = '{{$post->sub_category_id ?? null}}'
                    if (sub_category_id == sub_category.id){
                        selected = 'selected'
                    }
                }
                return sub_category_element.append(`<option ${selected} value="${sub_category.id}">${sub_category.name}</option>`)
            })
        })
    }

    // Make a request for a user with a given ID
    $('#category_id').on('change', function() {
        let category_id = $('#category_id').val()
        get_sub_categories(category_id)
        // handle success
    })
</script>
@if (Route::currentRouteName() == 'post.edit')
    <script>
        get_sub_categories('{{$post->category->id}}')
    </script>
@endif
