<h3>Installer (Beta)</h3>
<hr/>
<?php use Core\Helper\TimezoneHelper;

if (isset($vars['installQueued']) && $vars['installQueued']): ?>
    <h5 style="color: red; font-weight: bold;">Installation queued.</h5>
<?php elseif (isset($vars['deletionQueued']) && $vars['deletionQueued']): ?>
    <h5 style="color: red; font-weight: bold;">Uninstall queued.</h5>
<?php elseif (isset($vars['startEngineQueued']) && $vars['startEngineQueued']): ?>
    <h5 style="color: green; font-weight: bold;">Start engine queued.</h5>
<?php elseif (isset($vars['stopEngineQueued']) && $vars['stopEngineQueued']): ?>
    <h5 style="color: green; font-weight: bold;">Stop engine queued.</h5>
<?php elseif (isset($vars['restartEngineQueued']) && $vars['restartEngineQueued']): ?>
    <h5 style="color: green; font-weight: bold;">Restart engine queued.</h5>
<?php elseif (isset($vars['flushTokensQueued']) && $vars['flushTokensQueued']): ?>
    <h5 style="color: green; font-weight: bold;">Flush tokens queued.</h5>
<?php endif; ?>
<div style="width: 550px;">
    <ul>
        <?php foreach ($vars['errors'] as $err): ?>
            <li style="color: red; font-weight: bold"><?= $err; ?></li>
        <?php endforeach; ?>
    </ul>
    <?php if (!$vars['maximumServersReached']): ?>
        <script type="text/javascript">
            var configurationData = <?=json_encode($vars['configurations']);?>;
            var getInputValueByName = function (name) {
                return jQuery('[name="' + name + '"]').val();
            };
            $(document).ready(function () {
                jQuery('#configuration').change(function () {
                    value = $(this).val();
                    if (typeof configurationData[value] !== 'undefined') {
                        data = configurationData[value]['data'];
                        for (var key in data) {
                            jQuery('[name="' + key + '"]').val(data[key])
                        }
                    }
                });
                jQuery('#deleteConfigurationBtn').click(function (event) {
                    var id = getInputValueByName('configuration');
                    $.ajax({
                        method: "POST",
                        url: 'ajax.php?cmd=configuration&action=delete',
                        data: {
                            id: id
                        }
                    }).done(function () {
                        alert("Configuration removed.");
                        window.location.reload();
                    }).fail(function(){
                        alert("Failed to delete configuration.");
                    });
                });
                jQuery('#saveConfigurationBtn').click(function (event) {
                    var name = getInputValueByName('configurationName');

                    if (name === "") {
                        alert("Configuration name is empty.");
                        return;
                    }

                    data = {};

                    data['speed'] = getInputValueByName('speed');
                    data['mapSize'] = getInputValueByName('mapSize');
                    data['startGold'] = getInputValueByName('startGold');
                    data['protectionHours'] = getInputValueByName('protectionHours');
                    data['roundLength'] = getInputValueByName('roundLength');
                    data['isPromoted'] = getInputValueByName('isPromoted');
                    data['needPreregistrationCode'] = getInputValueByName('needPreregistrationCode');
                    data['buyAnimals'] = getInputValueByName('buyAnimals');
                    data['buyAnimalsInterval'] = getInputValueByName('buyAnimalsInterval');
                    data['buyResources'] = getInputValueByName('buyResources');
                    data['buyResourcesInterval'] = getInputValueByName('buyResourcesInterval');
                    data['buyTroops'] = getInputValueByName('buyTroops');
                    data['buyTroopsInterval'] = getInputValueByName('buyTroopsInterval');
                    data['startTimezone'] = getInputValueByName('startTimezone');
                    data['instantFinishTraining'] = getInputValueByName('instantFinishTraining');
                    data['buyAdventure'] = getInputValueByName('buyAdventure');
                    data['activation'] = getInputValueByName('activation');

                    $.ajax({
                        method: "POST",
                        url: 'ajax.php?cmd=configuration&action=save',
                        data: {
                            name: name,
                            data: JSON.stringify(data)
                        }
                    }).done(function () {
                        alert("Configuration saved.");
                        window.location.reload();
                    }).fail(function(){
                        alert("Failed to save configuration.");
                    });
                });
            });
        </script>
        <form method="post" action="admin.php?action=installNewServer">
            <table id="profile">
                <thead>
                <tr>
                    <th colspan="2">Settings</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Configuration</td>
                    <td>
                        <select name="configuration" id="configuration">
                            <option>Select configuration</option>
                            <?php foreach ($vars['configurations'] as $configuration): ?>
                                <option value="<?= $configuration['id']; ?>"><?= $configuration['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input id="deleteConfigurationBtn" type="button" value="Delete">
                    </td>
                </tr>
                <tr>
                    <th colspan="2">
                        <br/>
                    </th>
                </tr>
                <tr>
                    <td>World ID</td>
                    <td>
                        <input class="fm fm60" type="text" name="worldId" value="<?= $vars['formData']['worldId']; ?>"
                               required
                               minlength="1" maxlength="5">
                    </td>
                </tr>
                <tr>
                    <td>Server name</td>
                    <td>
                        <input class="fm" type="text" name="serverName" value="<?= $vars['formData']['serverName']; ?>"
                               minlength="1" required>
                    </td>
                </tr>
                <tr>
                    <td>Game speed</td>
                    <td>
                        <select class="fm" name="speed">
                            <?php foreach ($vars['data']['speeds'] as $key => $value): ?>
                                <option value="<?= $key; ?>" <?= ($key == $vars['formData']['speed'] ? 'selected' : ''); ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Map size</td>
                    <td>
                        <select class="fm" name="mapSize">
                            <?php foreach ($vars['data']['mapSize'] as $key => $value): ?>
                                <option value="<?= $key; ?>" <?= ($key == $vars['formData']['mapSize'] ? 'selected' : ''); ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Start gold</td>
                    <td>
                        <input class="fm fm60" type="number" name="startGold" required
                               value="<?= $vars['formData']['startGold']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Protection</td>
                    <td>
                        <input class="fm fm60" type="number" name="protectionHours" required
                               value="<?= $vars['formData']['protectionHours']; ?>"> hours
                    </td>
                </tr>
                <tr>
                    <td>Round length</td>
                    <td>
                        <select class="fm" name="roundLength">
                            <?php foreach ($vars['data']['roundLengths'] as $key => $value): ?>
                                <option value="<?= $key; ?>" <?= ($key == $vars['formData']['roundLength'] ? 'selected' : ''); ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Is tournament</td>
                    <td>
                        <select class="fm" name="isPromoted">
                            <?php foreach ($vars['data']['isPromoted'] as $key => $value): ?>
                                <option value="<?= $key; ?>" <?= ($key == $vars['formData']['isPromoted'] ? 'selected' : ''); ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Need preregistration code</td>
                    <td>
                        <select class="fm" name="needPreregistrationCode">
                            <?php foreach ($vars['data']['needPreregistrationCode'] as $key => $value): ?>
                                <option value="<?= $key; ?>" <?= ($key == $vars['formData']['needPreregistrationCode'] ? 'selected' : ''); ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Server hidden</td>
                    <td>
                        <select class="fm" name="serverHidden">
                            <?php foreach ($vars['data']['serverHidden'] as $key => $value): ?>
                                <option value="<?= $key; ?>" <?= ($key == $vars['formData']['serverHidden'] ? 'selected' : ''); ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th colspan="2" style="text-align: center">Features</th>
                </tr>
                <tr>
                    <td>Activation</td>
                    <td>
                        <select class="fm" name="activation">
                            <?php foreach ($vars['data']['activation'] as $key => $value): ?>
                                <option value="<?= $key; ?>" <?= ($key == $vars['formData']['activation'] ? 'selected' : ''); ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Buy adventure</td>
                    <td>
                        <select class="fm" name="buyAdventure">
                            <?php foreach ($vars['data']['buyAdventure'] as $key => $value): ?>
                                <option value="<?= $key; ?>" <?= ($key == $vars['formData']['buyAdventure'] ? 'selected' : ''); ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Instant finish training</td>
                    <td>
                        <select class="fm" name="instantFinishTraining">
                            <?php foreach ($vars['data']['instantFinishTraining'] as $key => $value): ?>
                                <option value="<?= $key; ?>" <?= ($key == $vars['formData']['instantFinishTraining'] ? 'selected' : ''); ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Buy Troops</td>
                    <td>
                        <select class="fm" name="buyTroops">
                            <?php foreach ($vars['data']['buyTroops'] as $key => $value): ?>
                                <option value="<?= $key; ?>" <?= ($key == $vars['formData']['buyTroops'] ? 'selected' : ''); ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select class="fm" name="buyTroopsInterval">
                            <?php foreach ($vars['data']['buyTroopsInterval'] as $key => $value): ?>
                                <option value="<?= $key; ?>" <?= ($key == $vars['formData']['buyTroopsInterval'] ? 'selected' : ''); ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Buy Animals</td>
                    <td>
                        <select class="fm" name="buyAnimals">
                            <?php foreach ($vars['data']['buyAnimals'] as $key => $value): ?>
                                <option value="<?= $key; ?>" <?= ($key == $vars['formData']['buyAnimals'] ? 'selected' : ''); ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select class="fm" name="buyAnimalsInterval">
                            <?php foreach ($vars['data']['buyAnimalsInterval'] as $key => $value): ?>
                                <option value="<?= $key; ?>" <?= ($key == $vars['formData']['buyAnimalsInterval'] ? 'selected' : ''); ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Buy Resources</td>
                    <td>
                        <select class="fm" name="buyResources">
                            <?php foreach ($vars['data']['buyResources'] as $key => $value): ?>
                                <option value="<?= $key; ?>" <?= ($key == $vars['formData']['buyResources'] ? 'selected' : ''); ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select class="fm" name="buyResourcesInterval">
                            <?php foreach ($vars['data']['buyResourcesInterval'] as $key => $value): ?>
                                <option value="<?= $key; ?>" <?= ($key == $vars['formData']['buyResourcesInterval'] ? 'selected' : ''); ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th colspan="2">
                        <br/>
                    </th>
                </tr>
                <tr>
                    <td>Start time</td>
                    <td>
                        <select class="fm" name="startTimezone">
                            <?php foreach ($vars['data']['startTimezone'] as $key => $value): ?>
                                <option value="<?= $key; ?>" <?= ($key == $vars['formData']['startTimezone'] ? 'selected' : ''); ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select class="fm" name="startDay">
                            <?php foreach ($vars['data']['startDay'] as $key => $value): ?>
                                <option value="<?= $key; ?>" <?= ($key == $vars['formData']['startDay'] ? 'selected' : ''); ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select class="fm" name="startHour">
                            <?php foreach ($vars['data']['startHour'] as $value): ?>
                                <option value="<?= $value; ?>" <?= ($value == $vars['formData']['startHour'] ? 'selected' : ''); ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th colspan="2">
                        <br/>
                    </th>
                </tr>
                <tr>
                    <td>Auto reinstall</td>
                    <td>
                        <select class="fm" name="auto_reinstall">
                            <?php foreach ($vars['data']['auto_reinstall'] as $key => $value): ?>
                                <option value="<?= $key; ?>" <?= ($key == $vars['formData']['auto_reinstall'] ? 'selected' : ''); ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Auto reinstall start after</td>
                    <td>
                        <select class="fm" name="auto_reinstall_start_after">
                            <?php foreach ($vars['data']['auto_reinstall_start_after'] as $key => $value): ?>
                                <option value="<?= $key; ?>" <?= ($key == $vars['formData']['auto_reinstall_start_after'] ? 'selected' : ''); ?>><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center">
                        <input type="image" src="img/admin/b/ok1.gif" value="submit" title="Queue to install">
                    </td>
                </tr>
                <tr>
                    <th colspan="2">
                        <br/>
                    </th>
                </tr>
                <tr>
                    <td>Save configuration as</td>
                    <td>
                        <input class="fm fm110" type="text" name="configurationName" value="">
                        <input id="saveConfigurationBtn" type="button" value="Save">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    <?php else: ?>
        <p class="warning" style="color: red; font-weight: bold">You cannot have more than 5 servers at the same time.
            Please remove the older servers.</p>
    <?php endif; ?>
</div>
<br/>
<table id="profile" style="width: 700px;">
    <thead>
    <tr>
        <th colspan="8">Servers</th>
    </tr>
    <tr>
        <td style="width: 45px;">ID</td>
        <td style="width: 30px;">WID</td>
        <td style="width: 125px;">Name</td>
        <td style="width: 75px;">Status</td>
        <td style="width: 75px;">Engine</td>
        <td style="width: 75px">Action</td>
        <td style="width: 125px">Login</td>
        <td style="width: 200px; ">Engine</td>
    </tr>
    </thead>
    <tbody>
    <?php if (sizeof($vars['gameWorlds']) <= 0): ?>
        <tr>
            <td colspan="8" style="text-align: center">No game worlds found.</td>
        </tr>
    <?php else: ?>
        <?php foreach ($vars['gameWorlds'] as $gameWorld): ?>
            <tr>
                <td style="text-align: center"><?= $gameWorld['id']; ?></td>
                <td style="width: 30px; text-align: center"><?= $gameWorld['worldId']; ?></td>
                <td style="width: 125px; text-align: center; overflow: hidden"><?= $gameWorld['name']; ?></td>
                <td style="width: 75px; text-align: center">
                    <?php
                    if ($gameWorld['finished'] == 1) {
                        echo '<span style="color: black; font-weight: bold">Finished</span>';
                    } else if ($gameWorld['startTime'] > time()) {
                        echo '<span style="color: orange; font-weight: bold">PreRegistration</span>';
                    } else {
                        echo '<span style="color: blue; font-weight: bold">Running</span>';
                    }
                    ?>
                </td>
                <td style="width: 75px; text-align: center">
                    <?php
                    if ($gameWorld['engine_status']) {
                        echo '<span style="color: blue; font-weight: bold">Running</span>';
                    } else {
                        echo '<span style="color: red; font-weight: bold">Stopped</span>';
                    }
                    ?>
                </td>
                <td style="width: 75px; text-align: center;">
                    <?php if (in_array($gameWorld['worldId'], ['dev', 'test']) || $gameWorld['finished'] == 1 || $gameWorld['startTime'] > time()): ?>
                        <a style="color: red" onclick="return confirmDeletion('<?= $gameWorld['worldId']; ?>');"
                           href="?action=installNewServer&worldId=<?= $gameWorld['worldId']; ?>&del=<?= $gameWorld['id']; ?>">
                            Delete
                        </a>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td style="width: 125px; text-align: center;">
                    <a target="_blank"
                       href="?action=installNewServer&worldUniqueId=<?= $gameWorld['id']; ?>&do=loginMH">MH</a>
                    | <a target="_blank"
                         href="?action=installNewServer&worldUniqueId=<?= $gameWorld['id']; ?>&do=loginSP">SP</a>
                </td>
                <td style="width: 200px; text-align: center">
                    <?php if ($gameWorld['engine_status']): ?>
                        <a style="color: black"
                           href="?action=installNewServer&do=stopGameEngine&worldId=<?= $gameWorld['worldId']; ?>">
                            Stop
                        </a>
                    <?php else: ?>
                        <a style="color: green"
                           href="?action=installNewServer&do=startGameEngine&worldId=<?= $gameWorld['worldId']; ?>">
                            Start
                        </a>
                    <?php endif; ?>
                    | <a style="color: orange"
                         href="?action=installNewServer&do=restartGameEngine&worldId=<?= $gameWorld['worldId']; ?>">Restart</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
<br/>
<a style="color: green" href="?action=installNewServer&do=flushTokens">
    » Flush tokens
</a>
<br/>
<br/>
<table id="profile">
    <thead>
    <tr>
        <th colspan="5">Tasks</th>
    </tr>
    <tr>
        <td style="width: 45px;">ID</td>
        <td style="width: 70px;">Type</td>
        <td>Description</td>
        <td style="width: 70px;">Status</td>
        <td>Date</td>
    </tr>
    </thead>
    <tbody>
    <?php if (sizeof($vars['tasks']) <= 0): ?>
        <tr>
            <td colspan="5" style="text-align: center">No tasks found.</td>
        </tr>
    <?php else: ?>
        <?php foreach ($vars['tasks'] as $task): ?>
            <tr>
                <td><?= $task['id']; ?></td>
                <td><?= $task['type']; ?></td>
                <td style="text-align: center"><?= $task['description']; ?></td>
                <td>
                    <?php
                    switch ($task['status']) {
                        case 'pending':
                            $color = 'orange';
                            break;
                        case 'done':
                            $color = 'green';
                            break;
                        case 'failed':
                            $color = 'red';
                            break;
                    }
                    echo '<span style="color: ' . $color . '; font-weight: bold"> ' . $task['status'] . ' </span> '
                    ?>
                </td>
                <td style="text-align: center"><?= TimezoneHelper::autoDate($task['time'], true, true); ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
<script type="text/javascript">
    function confirmDeletion(worldId) {
        return !!confirm("Are you sure you want to delete world " + worldId + "?");

    }
</script>
