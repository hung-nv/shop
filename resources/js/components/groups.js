Vue.component('article-group', {
    props: ['groupId', 'groupName', 'idsGroupArticle', 'articleId'],
    template: `<p class="margin-bottom-10">
                        @if(in_array($j->id, array_pluck($i->groups, 'id')))
                            <a href="javascript:;" class="btn btn-xs blue">
                                <i class="fa fa-check"></i>
                                {{ $j->value }}
                            </a>
                            <button class="btn btn-xs red" id="btnRemoveGroup"
                                    data-post-id="{{ $i->id }}"
                                    data-group-name="{{ $j->value }}"
                                    data-group-id="{{ $j->id }}">
                                <i class="fa fa-times"></i>
                            </button>
                        @else
                            <button class="btn btn-xs grey-cascade" id="btnAddGroup"
                                    data-post-id="{{ $i->id }}"
                                    data-group-name="{{ $j->value }}"
                                    data-group-id="{{ $j->id }}"> Set to "{{ $j->value }}"
                            </button>
                        @endif
                    </p>`,
    methods: {

    }
});