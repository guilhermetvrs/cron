function create(tag, flag) {
    return `<tr data-id="${flag}">
      <td scope="row">${tag.minute}</th>
      <td>${tag.hour}</td>
      <td>${tag.day}</td>
      <td>${tag.month}</td>
      <td>${tag.weekDay}</td>
      <td>${tag.task}</td>
      <td><i class="fa fa-times" onclick="removeRow(this)"></i></td>
    </tr>`
  }
  
  function removeRow(edit) {
    row = edit.parentElement.parentElement
    row.remove()
    const url = `codes/rm-task.php?remove=${row.dataset.id}`
    fetch(url)
  }
  
  const showTasksUrl = 'codes/show.php'
  const tasksTable = document.querySelector('table#tasks tbody')
  let tasks
  
  fetch(showTasksUrl)
    .then(res => res.json())
    .then(json => {
      tasks = json
      let crons = ''
      let flag = 0;
      for(let cron of tasks.crons) {
        crons += create(cron, flag++)
      }
      tasksTable.innerHTML = crons
    })