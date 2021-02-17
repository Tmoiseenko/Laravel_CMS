<style>
    .table {
        border-collapse: collapse;
    }
    .table th, .table td {
        border: 1px solid #e3e3e3;
        padding: 5px;
        text-align: left;
    }
    h1 {
        text-align: center;
        color: #0c5460;
    }
</style>
<div class="content">
    <h1>Итоговый отчет</h1>
    <table class="table">

        @foreach($data as $key=>$val)
            @if(isset($val['count']))
                <tr>
                    <th>{{ $val['title'] }}</th>
                    <td>{{ $val['count'] }}</td>
                </tr>
            @endif
        @endforeach

        @if(isset($data['mostPopularPost']))
            <tr>
                <th>{{ $data['mostPopularPost']['title'] }}</th>
                <td>{{ $data['mostPopularPost']['object']->title }}</td>
            </tr>
        @endif
        @if(isset($data['userWithMaxPost']))
            <tr>
                <th>{{ $data['userWithMaxPost']['title'] }}</th>
                <td>
                    кол-во: {{ $data['userWithMaxPost']['object']->posts_count }}<br>
                    Автор: {{ $data['userWithMaxPost']['object']->name }}
                </td>
            </tr>
        @endif
        @if(isset($data['postMaxBody']))
            <tr>
                <th>{{ $data['postMaxBody']['title'] }}</th>
                <td>
                    кол-во: {{ $data['postMaxBody']['object']->cnt }}<br>
                    Название: {{ $data['postMaxBody']['object']->title }}
                </td>
            </tr>
        @endif
        @if(isset($data['postMinBody']))
            <tr>
                <th>{{ $data['postMinBody']['title'] }}</th>
                <td>
                    кол-во: {{ $data['postMinBody']['object']->cnt }}<br>
                    Название: {{ $data['postMinBody']['object']->title }}
                </td>
            </tr>
        @endif
    </table>
</div>
