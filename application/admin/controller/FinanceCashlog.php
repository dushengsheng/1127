<?php
namespace app\admin\controller;

use think\Request;

class FinanceCashlog extends Base
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
    }

    public function cashlog()
    {
        $pageuser = checkPower();
        $cash_status = getConfig('user_cash_status');

        // 检查权限
        $sys_power = [];
        $sys_power['cashlog'] = hasPower($pageuser, 'Finance_CashLog') ? 1 : 0;
        $sys_power['pass'] = hasPower($pageuser, 'Finance_CashLogPass') ? 1 : 0;
        $sys_power['deny'] = hasPower($pageuser, 'Finance_CashLogDeny') ? 1 : 0;

        $data = [
            'sys_user' => $pageuser,
            'sys_power' => $sys_power,
            'cash_status' => $cash_status
        ];

        return $this->fetch("Finance/cashlog", $data);
    }

    public function cashlogList()
    {
        $pageuser = checkPower();
        $params = $this->params;

        $where = "where log.status<99";
        if ($pageuser['gid'] >= 61) {
            $uid_arr = getDownUser($pageuser['id']);
            $uid_arr[] = $pageuser['id'];
            $uid_str = implode(',', $uid_arr);
            $where .= " and (u.id in({$uid_str}) or u.appoint_agent in ({$uid_str}))";
        }

        if ($params['s_start_date'] && $params['s_end_date'] && $params['s_start_date'] <= $params['s_end_date']) {
            $s_start_date = strtotime($params['s_start_date'] . ' 00:00:00');
            $s_end_date = strtotime($params['s_end_date'] . ' 23:59:59');
            $where .= " and log.create_time between {$s_start_date} and {$s_end_date}";
        }
        if (isset($params['s_status']) && intval($params['s_status'])) {
            $where .= " and log.status={$params['s_status']}";
        }
        if (isset($params['s_keyword']) && $params['s_keyword']) {
            $s_keyword = $params['s_keyword'];
            $where .= " and (log.csn like '%{$s_keyword}%' or u.account like '%{$s_keyword}%' or u.nickname like '%{$s_keyword}%')";
        }

        $sql_cnt = "select count(1) as cnt,sum(log.money) as sum_money,sum(log.fee) as sum_fee 
		from cnf_cash_log log 
		left join cnf_card card on log.card_id=card.id 
		left join cnf_bank bk on card.bank_id=bk.id 
		left join sys_user u on log.uid=u.id {$where}";
        $count_item = $this->mysql->fetchRow($sql_cnt);

        $sql = "select log.*,bk.bank_name,u.gid,u.account,u.nickname 
		from cnf_cash_log log 
		left join cnf_card card on log.card_id=card.id 
		left join cnf_bank bk on card.bank_id=bk.id 
		left join sys_user u on log.uid=u.id {$where} order by log.id desc";
        $list = $this->mysql->fetchRows($sql, $params['page'], $params['limit']);

        debugLog('cashlogList: list = ' . var_export($list, true));

        $sys_group = getConfig('sys_group');
        $cnf_pay_status = getConfig('cnf_pay_status');
        $user_cash_status = getConfig('user_cash_status');
        foreach ($list as &$item) {
            $item['group_name'] = $sys_group[$item['gid']];
            $item['status_flag'] = $user_cash_status[$item['status']];
            $item['pay_status_flag'] = $cnf_pay_status[$item['pay_status']];
            $item['create_time'] = date('Y-m-d H:i:s', $item['create_time']);
            if ($item['check_time']) {
                $item['check_time'] = date('Y-m-d H:i:s', $item['check_time']);
            } else {
                $item['check_time'] = '';
            }
            if ($item['pay_time']) {
                $item['pay_time'] = date('Y-m-d H:i:s', $item['pay_time']);
            } else {
                $item['pay_time'] = '';
            }

            $card_info = json_decode($item['card_info'], true);
            $item['bank_name'] = $card_info['bank_name'];
        }
        $data = [
            'list' => $list,
            'count' => intval($count_item['cnt']),
            'sum_fee' => floatval($count_item['sum_fee']),
            'sum_money' => floatval($count_item['sum_money']),
        ];
        jReturn('0', 'ok', $data);
    }

    public function cashlogRollback()
    {
        jReturn('-1', 'cashlogRollback');
    }

    public function cashlogPass()
    {
        jReturn('-1', 'cashlogPass');
    }

    public function cashlogDeny()
    {
        jReturn('-1', 'cashlogDeny');
    }
}