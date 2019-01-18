let ui = {
    elementId: '#list-products'
};

if ($(ui.elementId).length) {
    let vmFilter = new Vue({
        el: ui.elementId,
        data: {
            pageSize: 10,
            sortBy: 1,
            labelSortBy: ''
        },
        watch: {
            sortBy: function (val) {
                this.labelSortBy = this.setLabelSortBy(val);
            }
        },
        created: function () {
            this.labelSortBy = this.setLabelSortBy(this.sortBy);
        },
        methods: {
            setPageSize: function (numeric, event) {
                this.pageSize = numeric;
            },
            setLabelSortBy: function (sortBy) {
                let label = '';

                switch (sortBy) {
                    case 1:
                        label = 'Mới nhất';
                        break;
                    case 2:
                        label = 'Giá: thấp - cao';
                        break;
                    case 3:
                        label = 'Giá: cao - thấp';
                        break;
                    case 4:
                        label = 'Tên sản phẩm: A - Z';
                        break;
                    default:
                        label = '';
                }

                return label;
            },
            setSortBy: function (type) {
                this.sortBy = type;
            }
        }
    });
}