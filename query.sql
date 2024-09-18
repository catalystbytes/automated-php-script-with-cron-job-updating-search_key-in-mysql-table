SELECT CONCAT('UPDATE dim_loan SET search_key = ''', CONCAT(user.first_name, ' ', user.last_name, ' ', user.email, ' ', user.mobile), ''' WHERE id = ', loan.id, ';') AS QUERY
FROM dim_loan loan
INNER JOIN dim_user user ON loan.created_by = user.id
  WHERE (search_key IS NULL OR search_key = '');
