### Integration

## admincp/core/status/site-statistics

> see \User\Service\UserListener::onSiteStatistics

```sql
INSERT INTO `pf5_core_event` 
(`id`, `event_name`, `listener_name`, `priority`) 
VALUES (NULL, 'onSiteStatistic', 'user.listener', '10');
 ```
 